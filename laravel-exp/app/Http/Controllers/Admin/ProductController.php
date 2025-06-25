<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;

class ProductController extends Controller
{
    public function product():View
    {
        $products = Product::WhereIn('id',function($query){$query->select('orders.product_id')
        ->from('orders')
        ->join('customers', 'orders.customer_id', '=', 'customers.id')
        ->where('customers.id', '=', '1');})
        ->select('name')
        ->get();

        return view('products.product', ['products' => $products]);
    }

    public function nogurintekku():View
    {
        $products = Product::WhereNotIn('id',function($query){$query->select('orders.product_id')
        ->from('orders')
        ->join('customers', 'orders.customer_id', '=', 'customers.id')
        ->where('customers.name', '=', '株式会社グリーンテック');})
        ->select('name')
        ->get();


        return view('products.nogurintekku', ['products' => $products]);
    }
}
