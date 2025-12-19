<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahunAjaran = TahunAjaran::orderByDesc('created_at')->get();

        return view('admin.dataMaster.tahunAjaran', compact('tahunAjaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        if ($request->status === 'aktif') {
            TahunAjaran::where('status', 'aktif')->update([
                'status' => 'nonaktif',
            ]);
        }

        TahunAjaran::create([
            'id' => Str::uuid(),
            'tahun' => $request->tahun,
            'status' => $request->status,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->back()->with('success', 'Tahun ajaran berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $tahun = TahunAjaran::withCount('pendaftar')->findOrFail($id);

        if ($tahun->pendaftar_count > 0) {
            return redirect()->back()
                ->with('error', 'Tahun ajaran tidak dapat dihapus karena sudah digunakan pendaftar');
        }

        $tahun->delete();

        return redirect()->back()->with('success', 'Tahun ajaran berhasil dihapus');
    }

    public function updateStatus(Request $request, $id)
    {
        $tahun = TahunAjaran::findOrFail($id);

        // jika diaktifkan, nonaktifkan yang lain
        if ($request->status === 'aktif') {
            TahunAjaran::where('status', 'aktif')->update([
                'status' => 'nonaktif',
            ]);
        }

        $tahun->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status tahun ajaran berhasil diubah',
        ]);
    }
}
