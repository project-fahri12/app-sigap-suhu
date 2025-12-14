<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pendaftar_id'   => 'required|integer',
            'nominal'        => 'required|numeric|min:0',
            'tanggal_bayar'  => 'required|date',
            'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $filePath = $request->file('bukti_transfer')
            ->store('bukti-transfer', 'public');

        Pembayaran::create([
            'pendaftar_id'   => Auth::id(), 
            'nominal'        => $request->nominal,
            'tanggal_bayar'  => $request->tanggal_bayar,
            'bukti_transfer' => $filePath,
            'status'         => 'Menunggu Verifikasi',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Pembayaran berhasil dikirim. Menunggu verifikasi panitia.');
    }
}
