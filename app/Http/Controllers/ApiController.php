<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function fetchDataFromApi(Request $r)
    {
        $client = new Client();
        $apiUrl = $r->apiUrl;

        try {
            $response = $client->get($apiUrl, [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            $data = $response->getBody()->getContents();

            $productData = json_decode($data);

            // insert into product table
            foreach ($productData->products as $product) {
                $productInsert = [
                    'product_name' => $product->title,
                    'product_desc' => $product->description,
                    'price' => $product->price,
                ];

                Product::create($productInsert);

                $newProduct = Product::latest()->first();

                $randomMonth = rand(1, 12);

                $randomYear = rand(2020, date('Y'));

                // auto generate sale data
                $saleData = [
                    'product_id' => $newProduct->id,
                    'quantity' => 1,
                    'total_value' => $newProduct->price,
                    'customer_id' => 1,
                    'month' => $randomMonth,
                    'year' => $randomYear,
                ];

                Sale::create($saleData);
            }



            return redirect()->back()->with('success', "Success fetch data from RESTful api");
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function getSalesData()
    {
        $data = Sale::get();

        return response()->json($data);
    }
}