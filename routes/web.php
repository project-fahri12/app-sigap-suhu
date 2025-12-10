<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\KontakController;
use App\Http\Controllers\Home\PendaftaranController;
use App\Http\Controllers\Home\PengumumanController;
use App\Http\Controllers\Home\ValidasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('validasi', [ValidasiController::class, 'index'])->name('validasi');
Route::get('kontak', [KontakController::class, 'index'])->name('kontak');
Route::get('pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran');
Route::get('pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');

//Auth
