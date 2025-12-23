<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use App\Services\Admin\VerifikasiService;

class VerifikasiController extends Controller
{
    protected $service;

    public function __construct(VerifikasiService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->getAll();

        return view('admin.verifikasi.verifikasi', [
            'dataBelum' => $data['belum'],
            'dataLolos' => $data['lolos'],
            'dataDitolak' => $data['ditolak'],
        ]);
    }

    public function update(Request $request)
    {
        $verifikasi = Verifikasi::where('pendaftar_id', $request->id)->firstOrFail();

        try {
            $this->service->update($verifikasi, $request->only([
                'status_file',
                'status_pay',
                'catatan',
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Verifikasi berhasil diperbarui!',
            ]);
        } catch (\DomainException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 403);
        }
    }
}
