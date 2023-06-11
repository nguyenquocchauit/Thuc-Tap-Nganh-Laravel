<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\User\UserController as UserUserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Host;
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
Route::get('/admin/login', [LoginAdminController::class, 'index'])->name('login-admin');

Route::prefix('shop')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('shop-index');
    // Route::get('/{categoryName}', [ShopController::class, 'category']);
});

//Admin
Route::middleware([Admin::class])->prefix('admin')->group(function () {
    Route::resource('customer', UserController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', AdminProductController::class);
    Route::resource('order', OrdersController::class);
    Route::get('/thong-tin-ca-nhan', [ProfileController::class, 'profile'])->name('edit');

});
//Host
Route::middleware([Host::class])->prefix('admin')->group(function () {
    Route::resource('employee', EmployeeController::class);
    Route::get('/report/customer', [ReportController::class, 'reportCustomer'])->name('reportCustomer');
    Route::get('/report/order', [ReportController::class, 'reportOrder'])->name('reportOrder');
    Route::get('/report/revenue', [ReportController::class, 'reportRevenue'])->name('reportRevenue');

});
// Customer
Route::middleware([User::class])->group(function () {
    Route::get('/thong-tin-ca-nhan', [UserUserController::class, 'profile'])->name('profile');
    Route::get('/lich-su-dat-hang', [UserUserController::class, 'purchaseHistory'])->name('purchaseHistory');
});
