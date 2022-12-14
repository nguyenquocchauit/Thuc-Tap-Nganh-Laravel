<?php

use App\Http\Controllers\Front;
use App\Http\Controllers\Front\ShopController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();
Route::get('/', [Front\HomeController::class, 'index']);

Route::prefix('shop')->group(function() {
     Route::get('/',[ShopController::class, 'index'])->name('shop-index');
     Route::get('/{categoryName}',[ShopController::class,'category']);
});
