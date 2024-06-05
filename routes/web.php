<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\KaratController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\DatewiseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GroupsController;

Route::get('/', [LoginController::class, 'index'])->name('admin.login');

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/dologin', [LoginController::class, 'dologin'])->name('admin.dologin');

Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::get('/', function () {
    return view('admin.login');
});

Route::group(['middleware' => ['auth']], function () {

    Route::resource('user', UserController::class);
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categorys', CategoryController::class);
    Route::resource('sliders', SliderController::class, ['expect' => 'show']);
    Route::resource('customer', CustomerController::class, ['expect' => 'show']);
    Route::get('customerlogin', [CustomerController::class, 'customerlogin'])->name('customerlogin');
    Route::get('customerAccess', [CustomerController::class, 'customerAccess'])->name('customerAccess');
    Route::get('customerAccessReq/{id}', [CustomerController::class, 'customerAccessReq/{id}'])->name('customerAccessReq/{id}');
    Route::resource('roles', RoleController::class);
    Route::resource('karat', KaratController::class, ['expect' => 'show']);
    Route::resource('sizes', SizeController::class, ['expect' => 'show']);
    Route::resource('products', ProductController::class, ['expect' => 'show']);
    Route::resource('groups', GroupsController::class, ['expect' => 'show']);
    Route::get('gridview', [ProductController::class, 'gridview'], ['expect' => 'show'])->name('gridview');
    Route::get('getsubcate', [ProductController::class, 'getsubcate'], ['expect' => 'show'])->name('getsubcate');
    Route::get('showSubCategory/{id}', [ProductController::class, 'showSubCategory'], ['expect' => 'show'])->name('showSubCategory');
    Route::get('showproductByCategory/{id}', [ProductController::class, 'showproductByCategory'], ['expect' => 'show'])->name('showproductByCategory');
    Route::get('deleteImage', [ProductController::class, 'deleteImage'], ['expect' => 'show'])->name('deleteImage');

    Route::resource('order', OrderController::class);
    Route::get('orderdetail/{id}', [OrderController::class, 'orderdetail'], ['expect' => 'show'])->name('orderdetail');

    Route::resource('holiday', HolidayController::class);
    Route::resource('datewise', DatewiseController::class);
});