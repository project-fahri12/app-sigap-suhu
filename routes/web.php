<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Home\KontakController;
use App\Http\Controllers\Pendaftar\UploadBerkas;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Home\ValidasiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GelombangController;
use App\Http\Controllers\Home\PengumumanController;
use App\Http\Controllers\Admin\SettingWebController;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\Home\PendaftaranController;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Admin\DataPendaftarController;
use App\Http\Controllers\Auth\PendaftarLoginController;
use App\Http\Controllers\Admin\SekolahPilihanController;
use App\Http\Controllers\Admin\KontakPendaftarController;
use App\Http\Controllers\Petugas\DashboardPetugasController;
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
    Route::get('admin/setting-web', [SettingWebController::class, 'index'])->name('setting-web.index');
    Route::post('admin/setting-web', [SettingWebController::class, 'update'])->name('setting-web.update');
    Route::resource('tahun-ajaran', TahunAjaranController::class)->only(['index', 'store', 'destroy']);
    Route::patch('tahun-ajaran/{id}/status', [TahunAjaranController::class, 'updateStatus'])->name('tahun-ajaran.status');
    Route::resource('gelombang', GelombangController::class)->only(['index', 'store', 'destroy', 'update']);
    Route::patch('gelombang/{id}/status', [GelombangController::class, 'updateStatus'])->name('gelombang.status');
    Route::resource('unit', UnitController::class)->only(['index', 'store', 'destroy']);
    Route::resource('sekolah-pilihan', SekolahPilihanController::class)->only(['index', 'store', 'destroy']);
    Route::resource('data-pendaftar', DataPendaftarController::class);
    Route::resource('verifikasi-pendaftar', VerifikasiController::class)->only(['index']);
    Route::resource('laporan', LaporanController::class)->only(['index']);
    Route::get('data-akun', [AkunController::class, 'index'])->name('data-akun.index');
    Route::post('data-akun', [AkunController::class, 'simpan'])->name('data-akun.store');
    Route::put('data-akun/{id}', [AkunController::class, 'ubah'])->name('data-akun.update');
    Route::delete('data-akun/{id}', [AkunController::class, 'hapus'])->name('data-akun.destroy');
    Route::get('kontak-pendaftar', [KontakPendaftarController::class, 'index'])->name('kontak-pendaftar');
    // export
    Route::get('laporan/export/excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
    Route::get('laporan/export/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
    Route::get('laporan/export/csv', [LaporanController::class, 'exportCsv'])->name('laporan.export.csv');
});

Route::post('verifikasi/update', [VerifikasiController::class, 'update'])->name('verifikasi.update'); //nutuh middlewarne lagi agar api amain


// Petugas
Route::middleware(['auth', 'auth.petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('data-pendaftar', DataPendaftarController::class);
    Route::resource('verifikasi-pendaftar', VerifikasiController::class)->only(['index']);
    Route::resource('laporan', LaporanController::class)->only(['index']);
});

// Pendaftar
Route::middleware(['auth', 'auth.pendaftar'])->prefix('pendaftar')->name('pendaftar.')->group(function () {
    Route::get('/dashboard', [DashboardPendaftarController::class, 'index'])->name('dashboard');
    Route::resource('upload-berkas', UploadBerkas::class)->only(['index', 'store']);
    Route::get('/pendaftar/cetak-bukti-pdf', [UploadBerkas::class, 'cetakBuktiPdf'])->name('cetak-bukti-pdf');
    Route::get('identitas-santri', [IdentitasSantriController::class, 'index'])->name('identitas.santri');
});
