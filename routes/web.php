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
use App\Http\Controllers\Admin\AdminAkunAdminController;
use App\Http\Controllers\Admin\AdminAkunMahasiswaController;
use App\Http\Controllers\Admin\AdminPeriodePendaftaranController;
use App\Http\Controllers\Admin\AdminPengumumanController;
use App\Http\Controllers\Admin\AdminBerkasController;

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
        Route::get('/admin-login', [AdminAuthController::class, 'viewLogin'])->name('admin-view-login');
        Route::post('/admin-login', [AdminAuthController::class, 'login'])->name('admin-login');
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

        Route::get('/admin/periode-pendaftaran', [AdminPeriodePendaftaranController::class, 'index'])->name('admin-view-periode-pendaftaran');
        Route::get('/admin/create-periode-pendaftaran', [AdminPeriodePendaftaranController::class, 'viewCreate'])->name('admin-view-create-periode-pendaftaran');
        Route::post('/admin/create-periode-pendaftaran', [AdminPeriodePendaftaranController::class, 'create'])->name('admin-create-periode-pendaftaran');
        Route::get('/admin/edit-periode-pendaftaran/{id}', [AdminPeriodePendaftaranController::class, 'viewEdit'])->name('admin-view-edit-periode-pendaftaran');
        Route::post('/admin/edit-periode-pendaftaran/{id}', [AdminPeriodePendaftaranController::class, 'edit'])->name('admin-edit-periode-pendaftaran');
        Route::post('/admin/delete-periode-pendaftaran/{id}', [AdminPeriodePendaftaranController::class, 'delete'])->name('admin-delete-periode-pendaftaran');

        Route::get('/admin/akun-admin', [AdminAkunAdminController::class, 'index'])->name('admin-view-akun-admin');
        Route::get('/admin/create-akun-admin', [AdminAkunAdminController::class, 'viewCreate'])->name('admin-view-create-akun-admin');
        Route::post('/admin/create-akun-admin', [AdminAkunAdminController::class, 'create'])->name('admin-create-akun-admin');
        Route::get('/admin/edit-akun-admin/{id}', [AdminAkunAdminController::class, 'viewEdit'])->name('admin-view-edit-akun-admin');
        Route::post('/admin/edit-akun-admin/{id}', [AdminAkunAdminController::class, 'edit'])->name('admin-edit-akun-admin');
        Route::post('/admin/delete-akun-admin/{id}', [AdminAkunAdminController::class, 'delete'])->name('admin-delete-akun-admin');

        Route::get('/admin/akun-mahasiswa', [AdminAkunMahasiswaController::class, 'index'])->name('admin-view-akun-mahasiswa');
        Route::get('/admin/akun-mahasiswa/{id}', [AdminAkunMahasiswaController::class, 'read'])->name('admin-read-akun-mahasiswa');
        Route::get('/admin/create-akun-mahasiswa', [AdminAkunMahasiswaController::class, 'viewCreate'])->name('admin-view-create-akun-mahasiswa');
        Route::post('/admin/create-akun-mahasiswa', [AdminAkunMahasiswaController::class, 'create'])->name('admin-create-akun-mahasiswa');
        Route::get('/admin/edit-akun-mahasiswa/{id}', [AdminAkunMahasiswaController::class, 'viewEdit'])->name('admin-view-edit-akun-mahasiswa');
        Route::post('/admin/edit-akun-mahasiswa/{id}', [AdminAkunMahasiswaController::class, 'edit'])->name('admin-edit-akun-mahasiswa');
        Route::get('/admin/reset-password-akun-mahasiswa/{id}', [AdminAkunMahasiswaController::class, 'resetPassword'])->name('admin-reset-password-akun-mahasiswa');
        Route::post('/admin/delete-akun-mahasiswa/{id}', [AdminAkunMahasiswaController::class, 'delete'])->name('admin-delete-akun-mahasiswa');

        Route::get('/admin/pengumuman', [AdminPengumumanController::class, 'index'])->name('admin-view-pengumuman');
        Route::get('/admin/pengumuman/{id}', [AdminPengumumanController::class, 'read'])->name('admin-read-pengumuman');
        Route::get('/admin/create-pengumuman', [AdminPengumumanController::class, 'viewCreate'])->name('admin-view-create-pengumuman');
        Route::post('/admin/create-pengumuman', [AdminPengumumanController::class, 'create'])->name('admin-create-pengumuman');
        Route::get('/admin/edit-pengumuman/{id}', [AdminPengumumanController::class, 'viewEdit'])->name('admin-view-edit-pengumuman');
        Route::post('/admin/edit-pengumuman/{id}', [AdminPengumumanController::class, 'edit'])->name('admin-edit-pengumuman');
        Route::get('/admin/delete-pengumuman-gambar/{id}', [AdminPengumumanController::class, 'deleteGambar'])->name('admin-delete-pengumuman-gambar');
        Route::post('/admin/delete-pengumuman/{id}', [AdminPengumumanController::class, 'delete'])->name('admin-delete-pengumuman');

        Route::get('/admin/berkas', [AdminBerkasController::class, 'index'])->name('admin-view-berkas');
        Route::get('/admin/berkas/{id}', [AdminBerkasController::class, 'download'])->name('admin-download-berkas');
        Route::get('/admin/create-berkas', [AdminBerkasController::class, 'viewCreate'])->name('admin-view-create-berkas');
        Route::post('/admin/create-berkas', [AdminBerkasController::class, 'create'])->name('admin-create-berkas');
        Route::get('/admin/edit-berkas/{id}', [AdminBerkasController::class, 'viewEdit'])->name('admin-view-edit-berkas');
        Route::post('/admin/edit-berkas/{id}', [AdminBerkasController::class, 'edit'])->name('admin-edit-berkas');
        Route::post('/admin/delete-berkas/{id}', [AdminBerkasController::class, 'delete'])->name('admin-delete-berkas');
    });
});
