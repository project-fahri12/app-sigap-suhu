<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;



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

return view('pendaftar.dashboard', compact('pembayaran'));
    }
}
