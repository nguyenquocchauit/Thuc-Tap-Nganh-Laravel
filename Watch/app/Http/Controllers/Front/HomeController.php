<?php

namespace App\Http\Controllers\Front;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        $allProducts = Product::get();
        return view('home',compact('allProducts'));
    }
}
