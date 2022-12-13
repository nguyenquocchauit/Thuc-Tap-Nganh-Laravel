<?php

use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Front\DetailProductController;
use App\Http\Controllers\Front\HomeController;
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
Route::get('/chi-tiet-san-pham/{id}', [DetailProductController::class, 'detailProduct'])->name('detail-product');
