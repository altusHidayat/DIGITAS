<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $guarded = [];

    public function getTotalSalesOverall()
    {
        return $this->sum('total_value');
    }

    public function getTotalSalesCurrentYear()
    {
        $year = date('Y');

        return $this->where('year', $year)->sum('total_value');
    }

    public function growthRate()
    {
        $totalSales = Sale::select('month', DB::raw('SUM(total_value) as total_sales'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Calculate growth rate
        $growthRateData = [];
        $previousSales = 0;

        foreach ($totalSales as $sale) {
            // Skip the first month as there's no previous data for comparison
            if ($previousSales !== 0) {
                $growthRate = (($sale->total_sales - $previousSales) / $previousSales) * 100;
            } else {
                $growthRate = 0; // Set growth rate as 0 for the first month
            }

            // Store the growth rate for the current month
            $growthRateData[$sale->month] = number_format($growthRate, 2);

            // Update previous sales for the next iteration
            $previousSales = $sale->total_sales;
        }

        return $growthRateData;
    }

    public function getSaleByMonth()
    {
        return Sale::select('month', DB::raw('SUM(total_value) as total_value'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    public function getTopSaleByProduct()
    {
        $top3Sales = $this->with([
            'product' => function ($query) {
                $query->select('id', 'product_name');
            }
        ])->select('product_id', DB::raw('SUM(quantity) as total_quantity_sold'), DB::raw('SUM(total_value) as total_sale'))
            ->groupBy('product_id')
            ->orderByDesc('total_sale')
            ->take(3)
            ->get();

        $result = [];

        foreach ($top3Sales as $top) {
            $result['total_sale'][] = [$top->total_sale];

            $result['product'][] = [$top->product->product_name];
        }

        return $result;
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}