<?php

use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Front\BuyProductController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\SearchProductController;
use App\Http\Controllers\User\UserController;
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
Route::post('/setting-profile', [UserController::class, 'updateProfile'])->name('setting-profile');
Route::get('/logout-user', [LoginUserController::class, 'logout'])->name('logout-user');
Route::get('/search-product/{search}', [ProductController::class, 'searchProduct'])->name('search-product');
Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::post('/remove-all-cart', [CartController::class, 'removeAllCart'])->name('remove-all-cart');
Route::get('/remove-product-by-id/{id}', [CartController::class, 'removeProductCart'])->name('remove-product-by-id');
Route::post('/update-quantity-cart', [CartController::class, 'updateQuantityCart'])->name('update-quantity-cart');
Route::post('/buy-product-from-cart', [BuyProductController::class, 'buyProductCart'])->name('buy-product-from-cart');
Route::post('/comment-product', [ProductController::class, 'writeComment'])->name('comment-product');
Route::post('/delete-comment', [ProductController::class, 'deleteComment'])->name('delete-comment');
Route::post('/like-product', [ProductController::class, 'likeProduct'])->name('like-product');
Route::post('/clear-like', [ProductController::class, 'removeLikeProduct'])->name('clear-like');
Route::post('/login-admin', [LoginAdminController::class, 'login'])->name('login-admin');
