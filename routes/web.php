<?php

use App\Models\Gelombang;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Home\KontakController;
use App\Http\Controllers\Pendaftar\UploadBerkas;
use App\Http\Controllers\Home\ValidasiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataPendaftarController;
use App\Http\Controllers\Admin\GelombangController;
use App\Http\Controllers\Home\PengumumanController;
use App\Http\Controllers\Admin\SettingWebController;
use App\Http\Controllers\Home\PendaftaranController;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Auth\PendaftarLoginController;
use App\Http\Controllers\Admin\SekolahPilihanController;
use App\Http\Controllers\Pendaftar\PembayaranController;
use App\Http\Controllers\Pendaftar\IdentitasSantriController;
use App\Http\Controllers\Pendaftar\DashboardPendaftarController;

// Public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('validasi', [ValidasiController::class, 'index'])->name('validasi');
Route::get('kontak', [KontakController::class, 'index'])->name('kontak');
Route::resource('pendaftaran', PendaftaranController::class)->only(['index', 'store']);
Route::get('pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
Route::get('/pendaftaran/sukses', [PendaftaranController::class, 'success'])->name('pendaftaran.sukses')->middleware('pendaftaran.success');
Route::post('/logout', [PendaftarLoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('guest')->group(function () {
    // Login Admin
    Route::get('login=r1', [LoginController::class, 'show'])->name('show.login');
    Route::post('login=r1', [LoginController::class, 'login'])->name('admin.login');
    // AuthUser
    Route::get('userLogin', [PendaftarLoginController::class, 'index'])->name('login');
    Route::post('userLoginProses', [PendaftarLoginController::class, 'userLoginProses'])->name('userLoginProses');
});


// Admin
Route::middleware(['auth', 'auth.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('setting-web', SettingWebController::class)->only(['index', 'update']);
    Route::resource('tahun-ajaran', TahunAjaranController::class)->only(['index', 'store', 'destroy']);
    Route::resource('gelombang', GelombangController::class)->only(['index', 'store', 'destroy']);;
    Route::resource('unit', UnitController::class)->only(['index', 'store', 'destroy']);;
    Route::resource('sekolah-pilihan', SekolahPilihanController::class)->only(['index', 'store', 'destroy']);;
    Route::resource('data-pendaftar', DataPendaftarController::class);
});

// Petugas
Route::prefix('petugas')->name('petugas.')->group(function () {
    Route::resource('dashboard', DashboardController::class);
});

// Pendaftar
Route::middleware(['auth', 'auth.pendaftar'])->prefix('pendaftar')->name('pendaftar.')->group(function () {
    Route::get('/dashboard', [DashboardPendaftarController::class, 'index'])->name('dashboard');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::resource('upload-berkas', UploadBerkas::class)->only(['index', 'store']);
    Route::get('/pendaftar/cetak-bukti-pdf', [UploadBerkas::class, 'cetakBuktiPdf'])->name('cetak-bukti-pdf');
    Route::get('identitas-santri', [IdentitasSantriController::class, 'index'])->name('identitas.santri');

});
