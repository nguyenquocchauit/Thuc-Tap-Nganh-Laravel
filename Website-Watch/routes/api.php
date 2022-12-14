<?php

use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\SearchProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login-user', [LoginUserController::class, 'login'])->name('login-user');
Route::post('/register-user', [RegisterUserController::class, 'register'])->name('register-user');
Route::get('/logout-user', [LoginUserController::class, 'logout'])->name('logout-user')->middleware('auth:sanctum');
Route::get('/search-product/{search}', [ProductController::class, 'searchProduct'])->name('search-product');
Route::get('/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add-to-cart');
Route::post('/remove-all-cart', [ProductController::class, 'removeAllCart'])->name('remove-all-cart');
Route::get('/remove-product-by-id/{id}', [ProductController::class, 'removeProductCart'])->name('remove-product-by-id');
Route::post('/update-quantity-cart', [ProductController::class, 'updateQuantityCart'])->name('update-quantity-cart');
