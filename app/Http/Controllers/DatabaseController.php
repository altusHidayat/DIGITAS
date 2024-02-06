<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\Sale;

class DatabaseController extends Controller
{
    public function changeConnection(Request $r)
    {
      Config::set('database.default', $r->connection);

      $data = Sale::get();

    return response()->json($data);
        // return response()->json(config('database.default'));
    }
}