<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PendaftarLoginController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\KontakController;
use App\Http\Controllers\Home\PendaftaranController;
use App\Http\Controllers\Home\PengumumanController;
use App\Http\Controllers\Home\ValidasiController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('validasi', [ValidasiController::class, 'index'])->name('validasi');
Route::get('kontak', [KontakController::class, 'index'])->name('kontak');
Route::resource('pendaftaran', PendaftaranController::class)->only(['index', 'store']);
Route::get('pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');

//AuthUser
Route::get('userLogin', [PendaftarLoginController::class,'index'])->name('login');
Route::post('userLoginProses', [PendaftarLoginController::class,'userLoginProses'])->name('userLoginProses');

//Admin
Route::middleware(['auth', 'auth.admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminControllwer::class, 'index'])->name('dashboard');
});

//Petugas
Route::prefix('petugas')->group(function() {
    Route::resource('dashboard', DashboardController::class);
});

//Pendaftar
Route::prefix('pendaftar')->group(function() {
    Route::resource('dashboard', DashboardController::class);
});