<?php

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\ShopController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/chi-tiet-san-pham/{id}', [ProductController::class, 'detailProduct'])->name('detail-product');
Route::get('/gio-hang', [ProductController::class, 'cart'])->name('view-cart');

Route::prefix('shop')->group(function() {
    Route::get('/',[ShopController::class, 'index'])->name('shop-index');
    Route::get('/{categoryName}',[ShopController::class,'category']);
});