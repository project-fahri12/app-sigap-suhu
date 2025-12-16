<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Verifikasi;

class DashboardController extends Controller
{
    public function index()
    {
        // STATISTIK PENDAFTAR
        $totalPendaftar = Pendaftar::count();
        // AMBIL DATA VERIFIKASI 
$belumBayar = Pendaftar::whereDoesntHave('verifikasi')
    ->orWhereHas('verifikasi', function ($q) {
        $q->where('verifikasi_pembayaran', 'pending');
    })
    ->count();

        $pendaftarTerbaru = Pendaftar::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPendaftar',
            'belumBayar',
            'pendaftarTerbaru'
        ));
    }
}
