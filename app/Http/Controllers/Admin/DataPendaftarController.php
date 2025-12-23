<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilterPendaftarRequest;
use App\Http\Requests\Admin\UpdatePendaftarRequest;
use App\Models\Pendaftar;
use App\Services\Admin\DataPendaftarService;

class DataPendaftarController extends Controller
{
    public function index(
        FilterPendaftarRequest $request,
        DataPendaftarService $service
    ) {
        $pendaftar = $service->paginate($request->validated());
        $statistik = $service->statistics();


        return view('admin.data.index', array_merge(
            compact('pendaftar'),
            $statistik,
        ));
    }


    public function show($id)
    {
        $pendaftar = Pendaftar::with([
            'gelombang',
            'tahunAjaran',
            'verifikasi',
            'pembayaran',
            'berkas',
            'orangTua',
            'waliSantri',
        ])->findOrFail($id);

        return view('admin.data.show', compact('pendaftar'));
    }

    public function edit($id)
    {
        $pendaftar = Pendaftar::with([
            'orangTua',
            'waliSantri',
        ])->findOrFail($id);

        return view('admin.data.edit', compact('pendaftar'));
    }

    public function update(
        UpdatePendaftarRequest $request,
        DataPendaftarService $service,
        $id
    ) {
        $service->update($id, $request->validated());

        return redirect()
            ->route('admin.data-pendaftar.index')
            ->with('success', 'Data pendaftar berhasil diperbarui');
    }

    public function destroy($id)
    {
        Pendaftar::findOrFail($id)->delete();

        return back()->with('success', 'Data pendaftar berhasil dihapus');
    }
}
