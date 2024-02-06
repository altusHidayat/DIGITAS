<?php

namespace App\Http\Controllers;

use App\Imports\CustomerImport;
use App\Imports\ProductImport;
use App\Imports\SaleImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Config;

class ExcelController extends Controller
{
    // public function upload(Request $r)
    // {

    //     $r->validate([
    //         'file' => 'required|mimes:xlsx,xls|max:2048',
    //     ], [
    //         'file.mimes' => 'The uploaded file must be an Excel spreadsheet (XLSX or XLS).',
    //     ]);

    //     $file = $r->file('file');

    //     $status = 'success';
    //     $msg = 'Success upload data from excel';

    //     $import = new SaleImport();
    //     try {
    //         Excel::import($import, $file);
    //     } catch (\Throwable $th) {
    //         $status = 'error';
    //         $msg = 'Error upload data from excel. File format is difference from template given. Please download from link above.';
    //     }

    //     return redirect()->back()->with($status, $msg);
    // }


    public function upload(Request $r, $type)
    {

        $r->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ], [
            'file.mimes' => 'The uploaded file must be an Excel spreadsheet (XLSX or XLS).',
        ]);

        $file = $r->file('file');

        $status = 'success';
        $msg = 'Success upload data from excel';

        if ($type == 'product') {
            $import = new ProductImport();
        }

        if ($type == 'customer') {
            $import = new CustomerImport();
        }

        if ($type == 'sale') {
            $import = new SaleImport();
        }

        try {
            Excel::import($import, $file);
        } catch (\Throwable $th) {
            $status = 'error';
            $msg = 'Error upload data from excel. File format is difference from template given. Please download from link above.';
        }

        return redirect()->back()->with($status, $msg);
    }
}