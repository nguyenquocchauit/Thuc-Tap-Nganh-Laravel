<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Auth\LoginAdminController as AuthLoginAdminController;
use App\Http\Controllers\User\UserController as UserUserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\User;
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
Route::get('/gio-hang', [CartController::class, 'cart'])->name('view-cart');

Route::prefix('shop')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('shop-index');
    Route::get('/{categoryName}', [ShopController::class, 'category']);
});

//Admin
Route::middleware([Admin::class])->prefix('admin')->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', AdminProductController::class);

});
Route::get('/admin/login', [AuthLoginAdminController::class, 'index'])->name('login-admin');
// user
Route::get('/thong-tin-ca-nhan', [UserUserController::class, 'index'])->name('profile')->middleware([User::class]);
