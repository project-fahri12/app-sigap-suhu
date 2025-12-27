<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingWebController;
use App\Http\Controllers\Pendaftar\DashboardPendaftarController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/midtrans-callback', [DashboardPendaftarController::class, 'callback']);
Route::post('/setting-web/ajax-update', [SettingWebController::class, 'ajaxUpdate']);