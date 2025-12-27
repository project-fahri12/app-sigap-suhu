<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Verifikasi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPendaftar = Pendaftar::count();

        $belumBayar = Pendaftar::with('verifikasi')->whereHas('verifikasi', function($q) {
            $q->where('verifikasi_berkas', 'pending');
        })->count();

        $pendaftarTerbaru = Pendaftar::with(['verifikasi', 'unit'])
            ->latest()
            ->limit(5)
            ->get();

        $hariLabels = [];
        $dataTren = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $hariLabels[] = $date->translatedFormat('d M'); 
            
            $count = Pendaftar::whereDate('created_at', $date->toDateString())->count();
            $dataTren[] = $count;
        }

        $statusPembayaran = [
            'valid'   => Verifikasi::where('verifikasi_pembayaran', 'valid')->count(),
            'pending' => Verifikasi::where('verifikasi_pembayaran', 'pending')->count(),
            'invalid' => Verifikasi::where('verifikasi_pembayaran', 'invalid')->count(),
            'belum'   => $totalPendaftar - Verifikasi::whereIn('verifikasi_pembayaran', ['valid', 'pending', 'invalid'])->count()
        ];

        return view('admin.dashboard', compact(
            'totalPendaftar',
            'belumBayar',
            'pendaftarTerbaru',
            'hariLabels',
            'dataTren',
            'statusPembayaran'
        ));
    }
}