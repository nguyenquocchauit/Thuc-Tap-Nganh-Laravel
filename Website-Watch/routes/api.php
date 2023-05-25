<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Front\BuyProductController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\SearchProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\User;
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
//middleware for customer
Route::middleware([User::class])->group(function () {
    Route::post('/setting-profile', [UserController::class, 'updateProfile'])->name('setting-profile');
    Route::post('/buy-product-from-cart', [BuyProductController::class, 'buyProductCart'])->name('buy-product-from-cart');
    Route::post('/comment-product', [ProductController::class, 'writeComment'])->name('comment-product');
    Route::post('/delete-comment', [ProductController::class, 'deleteComment'])->name('delete-comment');
    Route::post('/like-product', [ProductController::class, 'likeProduct'])->name('like-product');
    Route::post('/clear-like', [ProductController::class, 'removeLikeProduct'])->name('clear-like');
});
//middleware for employee
Route::middleware([Admin::class])->group(function () {
    Route::get('/admin/product/delete/{id}', [AdminProductController::class, 'destroy'])->name('delete-product');
    Route::post('/admin/product/update/{id}', [AdminProductController::class, 'update'])->name('update-product');
    Route::post('/admin/product/create', [AdminProductController::class, 'store'])->name('create-product');
    // product
    Route::post('/admin/customer/create', [AdminUserController::class, 'store'])->name('create-customer');
    Route::get('/admin/customer/edit/{id}', [AdminUserController::class, 'editCustomer'])->name('edit-customer');
    Route::post('/admin/customer/update/{id}', [AdminUserController::class, 'update'])->name('update-customer');
    Route::get('/admin/customer/delete/{id}', [AdminUserController::class, 'destroy'])->name('delete-customer');
    // customer
    Route::get('/admin/profile/edit/{id}', [ProfileController::class, 'editEmployee'])->name('edit-profile');
    Route::post('/admin/profile/update/{id}', [ProfileController::class, 'update'])->name('update-profile-dashboard');
    Route::post('/admin/profile/update-password/{id}', [ProfileController::class, 'updatePassword'])->name('update-password-dashboard');
    // profile-dashboard
    Route::post('/admin/brand/create', [BrandController::class, 'store'])->name('create-brand');
    Route::get('/admin/brand/delete/{id}', [BrandController::class, 'destroy'])->name('delete-brand');
    Route::post('/admin/brand/update/{id}', [BrandController::class, 'update'])->name('update-brand');
    // brand
    Route::post('/admin/employee/create', [EmployeeController::class, 'store'])->name('create-employee');
    Route::get('/admin/employee/delete/{id}', [EmployeeController::class, 'destroy'])->name('delete-employee');
    Route::get('/admin/employee/edit/{id}', [EmployeeController::class, 'editEmployee'])->name('edit-employee');
    // employee
});

// login and register of user
Route::post('/login-user', [LoginUserController::class, 'login'])->name('login-user');
Route::get('/logout-user', [LoginUserController::class, 'logout'])->name('logout-user');
Route::post('/register-user', [RegisterUserController::class, 'register'])->name('register-user');
// login of admin
Route::post('/login-admin', [LoginAdminController::class, 'login'])->name('login-admin');
Route::get('/logout-admin', [LoginAdminController::class, 'logout'])->name('logout-admin');


Route::get('/search-product/{search}', [ProductController::class, 'searchProduct'])->name('search-product');
Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::post('/remove-all-cart', [CartController::class, 'removeAllCart'])->name('remove-all-cart');
Route::get('/remove-product-by-id/{id}', [CartController::class, 'removeProductCart'])->name('remove-product-by-id');
Route::post('/update-quantity-cart', [CartController::class, 'updateQuantityCart'])->name('update-quantity-cart');
