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
            'status' => 'required|in:buka,tutup',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        if ($request->status === 'buka') {
            Gelombang::where('status', 'buka')->update([
                'status' => 'tutup',
            ]);
        }

        Gelombang::create($request->all());

        return redirect()->back()->with('success', 'Gelombang berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_gelombang' => 'required|string|max:100',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status' => 'required|in:buka,tutup',
        ]);

        $gelombang = Gelombang::findOrFail($id);

        // Jika diubah jadi buka → tutupkan yang lain
        if ($request->status === 'buka') {
            Gelombang::where('id', '!=', $id)
                ->where('status', 'buka')
                ->update(['status' => 'tutup']);
        }

        $gelombang->update($request->all());

        return back()->with('success', 'Gelombang berhasil diperbarui');
    }

    // Fitur Update Status Instan via AJAX
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:buka,tutup',
            ]);

            $gelombang = Gelombang::findOrFail($id);

            // Jika buka → tutup semua gelombang lain
            if ($request->status === 'buka') {
                Gelombang::where('status', 'buka')->update(['status' => 'tutup']);
            }

            $gelombang->update([
                'status' => $request->status,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status gelombang diperbarui',
                'status' => $request->status,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status',
            ], 500);
        }

    }

    public function destroy($id)
    {
        $gelombang = Gelombang::findOrFail($id);

        // Proteksi Hapus: Cek apakah ada pendaftar yang menggunakan ID gelombang ini
        if ($gelombang->pendaftar()->exists()) {
            return redirect()->back()->with('error', 'Data gagal dihapus! Sudah ada calon siswa yang mendaftar di gelombang ini.');
        }

        $gelombang->delete();

        return redirect()->back()->with('success', 'Gelombang berhasil dihapus');
    }
}
