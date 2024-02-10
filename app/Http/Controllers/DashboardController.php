<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class DashboardController extends Controller
{
    private $cm;
    private $pm;
    private $sm;

    public function __construct(Sale $sm, Product $pm, Customer $cm)
    {
        $this->cm = $cm;
        $this->pm = $pm;
        $this->sm = $sm;
    }

    public function dashboardView(Request $r)
    {
        $data['db'] = 'db2';

        Config::set('database.default', $data['db']);

        if ($r->connection) {
            Config::set('database.default', $r->connection);
            $data['db'] = $r->connection;
        }

        if (session('db')) {
            Config::set('database.default', session('db'));
            $data['db'] = session('db');
        }
        $data['startDate'] = '';
        $data['endDate'] = '';
        if ($r->startDate && $r->endDate) {
            $data['startDate'] = $r->startDate;
            $data['endDate'] = $r->endDate;
        }

        $querySales = $this->sm->with('product', 'customer')->orderBy('created_at', 'DESC');

        if ($data['startDate'] && $data['endDate']) {
            $querySales->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
        }

        $data['totalSales'] = $querySales->sum('total_value');

        $data['sales'] = $querySales->get();

        $data['salesOverall'] = number_format($this->sm->getTotalSalesOverall(), 2, '.', ',');
        $data['salesCurrentYear'] = number_format($this->sm->getTotalSalesCurrentYear(), 2, '.', ',');
        $data['totalCustomer'] = $this->cm->getTotalCustomer();
        $data['totalProduct'] = $this->pm->getTotalProduct();
        $data['products'] = $this->pm->all();
        $data['customers'] = $this->cm->all();
        $data['saleByMonth'] = $this->sm->getSaleByMonth();
        $data['topSaleByProduct'] = $this->sm->getTopSaleByProduct();

        $growthDatas = $this->sm->growthRate();

        if ($growthDatas) {
            foreach ($growthDatas as $growthData) {
                $growths[] = $growthData;
            }

            $data['growthRate'] = json_encode($growths);
        }

        return view('dashboard.dashboardView', $data);
    }
}