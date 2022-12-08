<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //

    public function index()
    {
        $allProducts = Product::get();
        $bestSellingProducts = Product::query()
            ->join('order_details', 'order_details.product', '=', 'products.id')
            ->selectRaw('products.*, SUM(order_details.quantity) AS quantity_sold')
            ->groupBy(['products.id']) // should group by primary key
            ->orderByDesc('quantity_sold')
            ->take(4) // 4 best-selling products
            ->get();
        return view('home', compact('allProducts','bestSellingProducts'));
    }
}
