<?php

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
    return view('auth.login');
});

Route::group(['middleware' => [
    'auth:sanctum',
    'verified',
    'accessrole'
]], function () {

    // Admin Panel

    Route::get('/user', function () {
        return view('admin.user');
    })->name('user');

     Route::get('/user-permission', function () {
        return view('admin.user-permission');
    })->name('user-permission');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/product', function () {
        return view('admin.product');
    })->name('product');

    Route::get('/vendor', function () {
        return view('admin.vendor');
    })->name('vendor');

    Route::get('/stock-entry', function () {
        return view('admin.stock-entry');
    })->name('stock-entry');

    Route::get('/stock-in-history', function () {
        return view('admin.stock-in-history');
    })->name('stock-in-history');

    Route::get('/category', function () {
        return view('admin.category');
    })->name('category');

    Route::get('/product', function () {
        return view('admin.product');
    })->name('product');

    Route::get('/size', function () {
        return view('admin.size');
    })->name('size');

    Route::get('/brand', function () {
        return view('admin.brand');
    })->name('brand');

    // Cashier Panel

    Route::get('/cashier', function () {
        return view('user.cashier');
    })->name('cashier');

});
