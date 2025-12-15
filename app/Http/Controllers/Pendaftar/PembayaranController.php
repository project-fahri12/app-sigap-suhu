<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:0',
            'tanggal_bayar' => 'required|date',
            'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $pendaftar = Pendaftar::where('users_id', Auth::id())->firstOrFail();

        // SIMPAN FILE
        $filePath = $request->file('bukti_transfer')
            ->store('bukti-transfer', 'public');

        // SIMPAN PEMBAYARAN (DATA SAJA)
        Pembayaran::create([
            'pendaftar_id' => $pendaftar->id,
            'nominal' => $request->nominal,
            'tanggal_bayar' => $request->tanggal_bayar,
            'bukti_transfer' => $filePath,
        ]);

        // BUAT / RESET VERIFIKASI
        \App\Models\Verifikasi::updateOrCreate(
            ['pendaftar_id' => $pendaftar->id],
            [
                'verifikasi_pembayaran' => 'pending',
                'verifikasi_berkas' => 'belum',
            ]
        );

        return back()->with('success', 'Pembayaran berhasil dikirim. Menunggu verifikasi panitia.');
    }
}

// jika sudah bayar maka tampilkan status dan alur, jika belum tampilkan pendaftaran
