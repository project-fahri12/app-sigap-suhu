<?php

namespace App\Http\Controllers\Pendaftar;

use App\Models\SettingWeb;
use App\Models\Pendaftar;
use App\Models\Pembayaran;
use App\Models\Berkas;
use App\Models\Verifikasi;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
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
        'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $pendaftar = Pendaftar::where('users_id', Auth::id())->firstOrFail();

    /* ================= PDF ================= */
    $pdfName = 'berkas_' . $pendaftar->id . '_' . time() . '.pdf';
    $pdfPath = $request->file('file')->storeAs(
        'berkas_pendaftar',
        $pdfName,
        'public'
    );

    /* ================= FOTO ================= */
    $fotoName = 'foto_' . $pendaftar->id . '_' . time() . '.' .
                $request->foto->extension();

    $fotoPath = $request->foto->storeAs(
        'foto_pendaftar',
        $fotoName,
        'public'
    );

    /* ================= SIMPAN DB ================= */
    Berkas::create([
        'id' => Str::uuid(),
        'pendaftar_id' => $pendaftar->id,
        'file_path' => $pdfPath,
        'foto_path' => $fotoPath,
        'keterangan' => 'Upload awal',
    ]);

    /* ================= VERIFIKASI ================= */
    Verifikasi::updateOrCreate(
        ['pendaftar_id' => $pendaftar->id],
        [
            'verifikasi_berkas' => 'pending',
            'tanggal' => now(),
        ]
    );

    return back()->with(
        'success',
        'Berkas & pas foto berhasil diupload. Menunggu verifikasi panitia.'
    );
}

public function cetakBuktiPdf()
{
    $pendaftar = Pendaftar::where('users_id', Auth::id())->firstOrFail();
    $verifikasi = Verifikasi::where('pendaftar_id', $pendaftar->id)->firstOrFail();

    $setting = SettingWeb::pluck('setting_value', 'setting_value')->toArray();

    $pdf = Pdf::loadView(
        'pendaftar.bukti-pendaftaran-pdf',
        compact('pendaftar', 'verifikasi', 'setting')
    )->setPaper('A4', 'portrait');

    return $pdf->stream(
        'BUKTI_PENDAFTARAN_'.$pendaftar->kode_pendaftaran.'.pdf'
    );
}

}
