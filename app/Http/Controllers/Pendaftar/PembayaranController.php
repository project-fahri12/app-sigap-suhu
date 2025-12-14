<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pendaftar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'nominal'        => 'required|numeric|min:0',
        'tanggal_bayar'  => 'required|date',
        'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $filePath = $request->file('bukti_transfer')
        ->store('bukti-transfer', 'public');

    $pendaftar = Pendaftar::where('users_id', Auth::id())->first();

    if (!$pendaftar) {
        return back()->withErrors('Data pendaftar tidak ditemukan.');
    }

    Pembayaran::create([
        'pendaftar_id'   => $pendaftar->id, 
        'nominal'        => $request->nominal,
        'tanggal_bayar'  => $request->tanggal_bayar,
        'bukti_transfer' => $filePath,
        'status'         => 'pending',
    ]);

    return back()->with('success', 'Pembayaran berhasil dikirim. Menunggu verifikasi panitia.');
}

}

// jika sudah bayar maka tampilkan status dan alur, jika belum tampilkan pendaftaran 