<?php

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

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/product', function () {
        return view('admin.product');
    })->name('product');

    Route::get('/category', function () {
        return view('admin.category');
    })->name('category');

    Route::get('/flavor', function () {
        return view('admin.flavor');
    })->name('flavor');

    Route::get('/size', function () {
        return view('admin.size');
    })->name('size');

});
