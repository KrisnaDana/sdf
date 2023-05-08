<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Http\Middleware\User;
use App\Http\Middleware\Guest;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UserBiodataController;
use App\Http\Controllers\Admin\AdminAuthController;

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

Route::middleware(['throttle:60,1'])->group(function () {
    //Guest
    Route::middleware([Guest::class])->group(function () {
        Route::get('/', [GuestController::class, 'index'])->name('index'); // Landing Page
        Route::get('/login', [GuestController::class, 'viewLogin'])->name('view-login');
        Route::post('/login', [GuestController::class, 'login'])->name('login');
    });

    //User
    Route::middleware([User::class])->group(function () {
        Route::get('/ganti-password', [UserBiodataController::class, 'gantiPassword'])->name('view-ganti-password');
        Route::post('/ganti-password', [UserBiodataController::class, 'biodata'])->name('ganti-password');
        Route::get('/biodata', [UserBiodataController::class, 'biodata'])->name('view-biodata');
        Route::post('/biodata', [UserBiodataController::class, 'biodata'])->name('biodata');
        Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');
    });

    //Admin
    Route::middleware([Admin::class])->group(function () {
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin-view-dashboard');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin-logout');
    });
});
