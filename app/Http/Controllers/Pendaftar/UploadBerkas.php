<?php

namespace App\Http\Controllers\Pendaftar;

use App\Models\Pendaftar;
use App\Models\Pembayaran;
use App\Models\Berkas;
use App\Models\Verifikasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UploadBerkas extends Controller
{
    public function index()
    {
        $pendaftar = Pendaftar::where('users_id', Auth::id())->firstOrFail();

        $pembayaran = Pembayaran::where('pendaftar_id', $pendaftar->id)
            ->latest()
            ->first();

        $berkas = Berkas::where('pendaftar_id', $pendaftar->id)
            ->latest()
            ->first();

        $verifikasi = Verifikasi::where('pendaftar_id', $pendaftar->id)->first();
        
        return view('pendaftar.uploadBerkas', compact(
            'pembayaran',
            'berkas',
            'verifikasi'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf|max:5120',
        ]);

        $pendaftar = Pendaftar::where('users_id', Auth::id())->firstOrFail();

        // Simpan file
        $filename = 'berkas_' . $pendaftar->id . '_' . time() . '.pdf';

        $path = $request->file('file')->storeAs(
            'berkas_pendaftar',
            $filename,
            'public'
        );

        // Simpan berkas (DATA SAJA)
        Berkas::create([
            'id' => Str::uuid(),
            'pendaftar_id' => $pendaftar->id,
            'file_path' => $path,
        ]);

        // Update / reset verifikasi
        Verifikasi::updateOrCreate(
            ['pendaftar_id' => $pendaftar->id],
            [
                'verifikasi_berkas' => 'pending',
                'tanggal' => now(),
            ]
        );

        return back()->with('success', 'Berkas berhasil diupload. Menunggu verifikasi panitia.');
    }
}
