<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;

class DashboardPendaftarController extends Controller
{
    public function index()
    {
$pendaftar = Pendaftar::where('users_id', Auth::id())->first();

$pembayaran = null;

if ($pendaftar) {
    $pembayaran = Pembayaran::where('pendaftar_id', $pendaftar->id)
        ->latest()
        ->first();
}

return view('pendaftar.pembayaran', compact('pembayaran'));
    }
}
