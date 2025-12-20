<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            'status' => 'required|in:aktif,nonaktif',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        // Ambil tahun dari tanggal
        $tahunMulai = Carbon::parse($request->tanggal_mulai)->year;
        $tahunSelesai = Carbon::parse($request->tanggal_selesai)->year;

        // Format tahun ajaran: 2024/2025
        $tahunAjaran = $tahunMulai.'/'.$tahunSelesai;

        // Jika status aktif, nonaktifkan yang lain
        if ($request->status === 'aktif') {
            TahunAjaran::where('status', 'aktif')->update([
                'status' => 'nonaktif',
            ]);
        }
        $exists = TahunAjaran::where('tahun', $tahunAjaran)->exists();

        if ($exists) {
            return back()->with('error', 'Tahun ajaran sudah ada');
        }

        TahunAjaran::create([
            'id' => Str::uuid(),
            'tahun' => $tahunAjaran,
            'status' => $request->status,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return back()->with('success', 'Tahun ajaran berhasil ditambahkan');
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
