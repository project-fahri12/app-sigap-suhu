<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pendaftar;
use Illuminate\Support\Facades\Auth;

class DashboardPendaftarController extends Controller
{
    public function index()
    {
        $santri = Pendaftar::where('users_id', Auth::id())->firstOrFail();

        $pembayaran = Pembayaran::where('pendaftar_id', $santri->id)
            ->latest()
            ->first();

        $verifikasi = \App\Models\Verifikasi::where('pendaftar_id', $santri->id)->first();

        return view('pendaftar.dashboard', compact(
            'santri',
            'pembayaran',
            'verifikasi'
        ));
    }
}
