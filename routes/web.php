<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Pendaftar\DashboardPendaftarController;
use App\Http\Controllers\Pendaftar\PembayaranController;
use App\Http\Controllers\Auth\PendaftarLoginController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\KontakController;
use App\Http\Controllers\Home\PendaftaranController;
use App\Http\Controllers\Home\PengumumanController;
use App\Http\Controllers\Home\ValidasiController;
use App\Http\Controllers\Pendaftar\UploadBerkas;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('validasi', [ValidasiController::class, 'index'])->name('validasi');
Route::get('kontak', [KontakController::class, 'index'])->name('kontak');
Route::resource('pendaftaran', PendaftaranController::class)->only(['index', 'store']);
Route::get('pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
Route::get('/pendaftaran/sukses', [PendaftaranController::class, 'success'])->name('pendaftaran.sukses')->middleware('pendaftaran.success');
Route::post('/logout', [PendaftarLoginController::class,'logout'])->name('logout')->middleware('auth');

//AuthUser
Route::get('userLogin', [PendaftarLoginController::class,'index'])->name('login');
Route::post('userLoginProses', [PendaftarLoginController::class,'userLoginProses'])->name('userLoginProses');

//Admin
Route::middleware(['auth', 'auth.admin'])->prefix('admin')->group(function () {
    // Route::get('dashboard', [AdminControllwer::class, 'index'])->name('dashboard');
});

//Petugas
Route::prefix('petugas')->name('petugas.')->group(function() {
    Route::resource('dashboard', DashboardController::class);
});

// Pendaftar
Route::middleware(['auth', 'auth.pendaftar'])->prefix('pendaftar')->name('pendaftar.')->group(function () {
        Route::get('/dashboard', [DashboardPendaftarController::class, 'index'])->name('dashboard');
        Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
        Route::resource('upload-berkas', UploadBerkas::class)->only(['index', 'store']);
        
    });
