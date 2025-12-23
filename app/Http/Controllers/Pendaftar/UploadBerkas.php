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
use App\Http\Requests\StoreBerkasRequest;
use App\Services\PPDB\BerkasService;
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

   public function store(StoreBerkasRequest $request, BerkasService $service) {
    try{
        //mencari user id di tabel pendaftar bersarakan login
        $pendaftar = Pendaftar::where('users_id', Auth::id())->firstOrFail();
        //memanggil servics berkas req untuk logika bisnis
   $service->upload($pendaftar,$request->validated());
        //mengembalikan succes jika berhasil
        return back()->with('success', 'berkas berhasil diupload, Mengunggu verifikasi panita');
    } catch(\DomainException $e) {
        return back()->with('error', $e->getMessage());
    }
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
