<?php

namespace App\Imports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SaleImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Customize this according to your Excel file structure
        return new Sale([
            'product_id' => $row['product_id'],
            'quantity' => $row['quantity'],
            'sale_value' => $row['sale_value'],
            'total_value' => $row['total_value'],
            'customer_id' => $row['customer_id'],
            'month' => $row['month'],
            'year' => $row['year'],
            // Add more columns as needed
        ]);
    }
}