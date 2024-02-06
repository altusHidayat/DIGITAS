<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class CustomerImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Customer([
            'customer_name' => $row['customer_name'],
            'address' => $row['address'],
            'phone' => $row['phone'],
            'email' => $row['email'],
        ]);
    }
}