<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\AuthClientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthSupplierController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CouponClientController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ScheduleController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/', function () {

    if (User::isSupplier()){
        return redirect()->route('dashsup');
    }
    if (User::isClient()){
        return redirect()->route('dashcli');
    }

    return view('landing');
})->name('home');

Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed', 'auth']);
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend')->middleware('auth');

Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(AuthClientController::class)->group(function() {
    Route::get('/client-registration', 'register')->name('register-client');
    Route::post('/store-client', 'store')->name('store-client');
});

Route::controller(AuthSupplierController::class)->group(function() {
    Route::get('/supplier-registration', 'register')->name('register-supplier');
    Route::post('/store-supplier', 'store')->name('store-supplier');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('favorites/{id}/add', [FavoriteController::class, 'addFavorite'])->name('favorites.add');
    Route::post('favorites/{id}/remove', [FavoriteController::class, 'removeFavorite'])->name('favorites.remove');

    Route::get('/dashcli', [AuthClientController::class, 'dashboard'])->name('dashcli')->middleware('checkClient');
    Route::get('/dashsup', [AuthSupplierController::class, 'dashboard'])->name('dashsup')->middleware('checkSupplier');
    Route::get('/show/{product}', [AuthClientController::class, 'show'])->name('show')->middleware('checkClient');

    Route::post('/show/{product}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('checkClient');
    Route::get('/coupon/show', [CouponController::class, 'show'])->name('coupon.show');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/supplier/{supplier}/schedule', [AuthSupplierController::class, 'updateSchedule'])->name('supplier.updateSchedule')->middleware('checkSupplier');
    Route::resource('coupons', CouponController::class);
    Route::post('register-visit/{id}', [CouponClientController::class, 'register'])->name('visit.register');
    Route::post('use-coupon/{id}', [CouponClientController::class, 'useCoupon'])->name('coupon.use');
});
