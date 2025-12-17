<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Verifikasi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPendaftar = Pendaftar::count();

        $belumBayar = Pendaftar::whereDoesntHave('verifikasi')
            ->orWhereHas('verifikasi', function ($q) {
                $q->where('verifikasi_pembayaran', 'pending');
            })
            ->count();

        $pendaftarTerbaru = Pendaftar::with(['verifikasi', 'unit'])
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPendaftar',
            'belumBayar',
            'pendaftarTerbaru'
        ));
    }
}
