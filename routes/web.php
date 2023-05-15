<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Http\Middleware\User;
use App\Http\Middleware\Guest;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UserPengumumanController;
use App\Http\Controllers\User\UserRegistrasiController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminJalurPendaftaranController;
use App\Http\Controllers\Admin\AdminProgramStudiController;

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
        Route::get('/pengumuman', [UserPengumumanController::class, 'viewPengumuman'])->name('view-pengumuman');
        Route::get('/registrasi', [UserRegistrasiController::class, 'viewRegistrasi'])->name('view-registrasi');
        Route::post('/registrasi', [UserRegistrasiController::class, 'registrasi'])->name('registrasi');
    });

    //Admin
    Route::middleware([Admin::class])->group(function () {
        Route::get('/admin/coming-soon', [AdminAuthController::class, 'comingSoon'])->name('admin-view-coming-soon');
        Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin-logout');
        Route::get('/admin/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin-view-dashboard');

        Route::get('/admin/jalur-pendaftaran', [AdminJalurPendaftaranController::class, 'index'])->name('admin-view-jalur-pendaftaran');
        Route::get('/admin/create-jalur-pendaftaran', [AdminJalurPendaftaranController::class, 'viewCreate'])->name('admin-view-create-jalur-pendaftaran');
        Route::post('/admin/create-jalur-pendaftaran', [AdminJalurPendaftaranController::class, 'create'])->name('admin-create-jalur-pendaftaran');
        Route::get('/admin/edit-jalur-pendaftaran/{id}', [AdminJalurPendaftaranController::class, 'viewEdit'])->name('admin-view-edit-jalur-pendaftaran');
        Route::post('/admin/edit-jalur-pendaftaran/{id}', [AdminJalurPendaftaranController::class, 'edit'])->name('admin-edit-jalur-pendaftaran');
        Route::post('/admin/delete-jalur-pendaftaran/{id}', [AdminJalurPendaftaranController::class, 'delete'])->name('admin-delete-jalur-pendaftaran');

        Route::get('/admin/program-studi', [AdminProgramStudiController::class, 'index'])->name('admin-view-program-studi');
        Route::get('/admin/program-studi/{id}', [AdminProgramStudiController::class, 'read'])->name('admin-read-program-studi');
        Route::get('/admin/create-program-studi', [AdminProgramStudiController::class, 'viewCreate'])->name('admin-view-create-program-studi');
        Route::post('/admin/create-program-studi', [AdminProgramStudiController::class, 'create'])->name('admin-create-program-studi');
        Route::get('/admin/edit-program-studi/{id}', [AdminProgramStudiController::class, 'viewEdit'])->name('admin-view-edit-program-studi');
        Route::post('/admin/edit-program-studi/{id}', [AdminProgramStudiController::class, 'edit'])->name('admin-edit-program-studi');
        Route::get('/admin/delete-program-studi-qr-code/{id}', [AdminProgramStudiController::class, 'deleteQrCode'])->name('admin-delete-program-studi-qr-code');
        Route::post('/admin/delete-program-studi/{id}', [AdminProgramStudiController::class, 'delete'])->name('admin-delete-program-studi');
    });
});
