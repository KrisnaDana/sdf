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
        Route::get('/secret-login', [AdminAuthController::class, 'viewLogin'])->name('admin-view-login');
        Route::post('/secret-login', [AdminAuthController::class, 'login'])->name('admin-login');
    });

    //User
    Route::middleware([User::class])->group(function () {
        Route::get('/coming-soon', [UserAuthController::class, 'comingSoon'])->name('view-coming-soon');
        Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');
        Route::get('/ganti-password', [UserAuthController::class, 'viewGantiPassword'])->name('view-ganti-password');
        Route::post('/ganti-password', [UserAuthController::class, 'gantiPassword'])->name('ganti-password');
        Route::get('/pengumuman', [UserBiodataController::class, 'viewPengumuman'])->name('view-pengumuman');
        Route::get('/biodata', [UserBiodataController::class, 'viewBiodata'])->name('view-biodata');
        Route::post('/biodata', [UserBiodataController::class, 'biodata'])->name('biodata');
    });

    //Admin
    Route::middleware([Admin::class])->group(function () {
        Route::get('/admin/coming-soon', [AdminAuthController::class, 'comingSoon'])->name('admin-view-coming-soon');
        Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin-logout');
        Route::get('/admin/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin-view-dashboard');
    });
});
