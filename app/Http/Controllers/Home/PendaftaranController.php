<?php

namespace App\Http\Controllers\Home;

use App\Models\Unit;
use App\Models\Gelombang;
use App\Models\TahunAjaran;
use App\Models\SekolahPilihan;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePendaftaranRequest;
use App\Services\PPDB\PendaftaranService;

class PendaftaranController extends Controller
{
    protected PendaftaranService $pendaftaranService;

    public function __construct(PendaftaranService $pendaftaranService)
    {
        $this->pendaftaranService = $pendaftaranService;
    }

    public function index()
    {
        if (setting('status_ppdb') === 'tutup') {
            return view('home.pendaftaran_closed');
        }

        return view('home.form_santri', [
            'tahun_ajaran' => TahunAjaran::select('id', 'tahun')
                ->where('status', 'aktif')
                ->orderByDesc('tahun')
                ->first(),

            'gelombang' => Gelombang::select('id', 'nama_gelombang')
                ->where('status', 1)
                ->orderBy('tanggal_mulai')
                ->first(),

            'unit_options' => Unit::select('id', 'nama_unit')->get(),
            'sekolah_options' => SekolahPilihan::select('id', 'nama_sekolah')->get(),
        ]);
    }

    
    public function store(StorePendaftaranRequest $request)
    {
        $kode = $this->pendaftaranService
            ->register($request->validated());

        return redirect()
            ->route('pendaftaran.sukses')
            ->with('registration_code', $kode);
    }

    public function success()
    {
        $registration_code = session('registration_code');

        if (! $registration_code) {
            return redirect()
                ->route('pendaftaran.index')
                ->with('error', 'Akses tidak sah ke halaman sukses.');
        }

        return view('home.kodePendaftaran', compact('registration_code'));
    }
}
