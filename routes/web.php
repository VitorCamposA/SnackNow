<?php

use App\Http\Controllers\AuthClientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthSupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.home');
});

Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(AuthClientController::class)->group(function() {
    Route::get('/client-registration', 'register')->name('register-client');
    Route::get('/client-show/{product}', 'show')->name('show-client');
    Route::post('/store-client', 'store')->name('store-client');
});

Route::controller(AuthSupplierController::class)->group(function() {
    Route::get('/supplier-registration', 'register')->name('register-supplier');
    Route::get('/supplier-show', 'show')->name('show-supplier');
    Route::post('/store-supplier', 'store')->name('store-supplier');
});

