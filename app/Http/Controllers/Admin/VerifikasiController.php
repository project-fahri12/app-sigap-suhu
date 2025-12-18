<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Verifikasi;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
{
   
    $dataBelum = Pendaftar::with(['verifikasi', 'unit', 'berkas'])
        ->whereDoesntHave('verifikasi')
        ->orWhereHas('verifikasi', function ($q) {
            $q->where('verifikasi_pembayaran', 'pending')
              ->orWhere('verifikasi_berkas', 'pending');
        })
        ->get();

    $dataLolos = Pendaftar::with(['verifikasi', 'unit', 'berkas'])
        ->whereHas('verifikasi', function ($q) {
            $q->where('verifikasi_pembayaran', 'valid')
              ->where('verifikasi_berkas', 'valid');
        })
        ->get();

    $dataDitolak = Pendaftar::with(['verifikasi', 'unit', 'berkas'])
        ->whereHas('verifikasi', function ($q) {
            $q->where('verifikasi_pembayaran', 'invalid')
              ->orWhere('verifikasi_berkas', 'invalid');
        })
        ->get();

    return view(
        'admin.verifikasi.verifikasi',
        compact('dataBelum', 'dataLolos', 'dataDitolak')
    );
}


    public function update(Request $request)
{
    $v = Verifikasi::where('pendaftar_id', $request->id)->first();

    if (!$v) {
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }

    if ($request->has('status_pay')) {
        $v->verifikasi_pembayaran = $request->status_pay;
    }

    if ($request->has('status_file')) {
        $v->verifikasi_berkas = $request->status_file;
    }

    if ($request->has('catatan')) {
        $v->catatan = strtoupper($request->catatan);
    }

    $v->diverifikasi_oleh = auth()->id();
    $v->tanggal = date('Y-m-d');
    $v->save();

    return response()->json([
        'success' => true,
        'message' => 'Verifikasi berhasil diperbarui!'
    ]);
}
}
