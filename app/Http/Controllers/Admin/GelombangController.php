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
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        Gelombang::create($request->all());

        return redirect()->back()->with('success', 'Gelombang berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_gelombang' => 'required|string|max:255',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
            'status' => 'required|in:dibuka,ditutup',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        $gelombang = Gelombang::findOrFail($id);
        $gelombang->update($request->all());

        return redirect()->back()->with('success', 'Gelombang berhasil diperbarui');
    }

    // Fitur Update Status Instan via AJAX
    public function updateStatus(Request $request, $id)
    {
        try {
            $gelombang = Gelombang::findOrFail($id);

            // Validasi input
            if (! in_array($request->status, ['buka', 'tutup'])) {
                return response()->json(['success' => false, 'message' => 'Status tidak valid'], 400);
            }

            $gelombang->status = $request->status;
            $gelombang->save();

            return response()->json([
                'success' => true,
                'message' => 'Gelombang '.$gelombang->nama_gelombang.' berhasil '.$request->status,
            ]);

        } catch (\Exception $e) {
            // Ini akan mengirimkan pesan error asli ke AJAX jika terjadi kegagalan
            return response()->json([
                'success' => false,
                'message' => 'Server Error: '.$e->getMessage(),
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
