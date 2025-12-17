<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class GelombangController extends Controller
{
    public function index()
    {
        $gelombang = Gelombang::with('tahunAjaran')
            ->orderByDesc('created_at')
            ->get();

        $tahunAjaran = TahunAjaran::orderByDesc('created_at')->get();

        return view('admin.dataMaster.gelombang', compact('gelombang', 'tahunAjaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_gelombang' => 'required|string|max:255',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
            'status' => 'required|in:dibuka,ditutup',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai'
        ]);

        Gelombang::create([
            'nama_gelombang' => $request->nama_gelombang,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'status' => $request->status,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);

        return redirect()->back()->with('success', 'Gelombang berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Gelombang::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Gelombang berhasil dihapus');
    }
}
