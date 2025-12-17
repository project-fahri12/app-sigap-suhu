<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Gelombang;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class DataPendaftarController extends Controller
{
    /**
     * =================================================
     * INDEX
     * =================================================
     * List data pendaftar + filter + statistik
     */
    public function index(Request $request)
    {
        // ===============================
        // QUERY UTAMA
        // ===============================
        $query = Pendaftar::with([
            'gelombang',
            'tahunAjaran',
            'verifikasi',
        ])->latest();

        // ===============================
        // FILTER TAHUN AJARAN
        // ===============================
        if ($request->filled('tahun_ajaran')) {
            $query->where('tahun_ajaran_id', $request->tahun_ajaran);
        }

        // ===============================
        // FILTER GELOMBANG
        // ===============================
        if ($request->filled('gelombang')) {
            $query->where('gelombang_id', $request->gelombang);
        }

        // ===============================
        // FILTER STATUS VERIFIKASI
        // ===============================
        if ($request->filled('status')) {

            // VALID
            if ($request->status === 'valid') {
                $query->whereHas('verifikasi', function ($q) {
                    $q->where('verifikasi_berkas', 'valid')
                      ->where('verifikasi_pembayaran', 'valid');
                });
            }

            // PENDING
            if ($request->status === 'pending') {
                $query->whereHas('verifikasi', function ($q) {
                    $q->where(function ($x) {
                        $x->where('verifikasi_berkas', 'pending')
                          ->orWhere('verifikasi_pembayaran', 'pending');
                    });
                });
            }

            // DITOLAK
            if ($request->status === 'ditolak') {
                $query->whereHas('verifikasi', function ($q) {
                    $q->where(function ($x) {
                        $x->where('verifikasi_berkas', 'ditolak')
                          ->orWhere('verifikasi_pembayaran', 'ditolak');
                    });
                });
            }
        }

        // ===============================
        // SEARCH
        // ===============================
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_pendaftaran', 'like', '%' . $request->search . '%');
            });
        }

        // ===============================
        // PAGINATION
        // ===============================
        $pendaftar = $query->paginate(10)->withQueryString();

        // ===============================
        // DATA FILTER
        // ===============================
        $tahunAjaran = TahunAjaran::orderBy('tahun', 'desc')->get();
        $gelombang   = Gelombang::orderBy('nama_gelombang')->get();

        // ===============================
        // STATISTIK
        // ===============================
        $total = Pendaftar::count();

        $terverifikasi = Pendaftar::whereHas('verifikasi', function ($q) {
            $q->where('verifikasi_berkas', 'valid')
              ->where('verifikasi_pembayaran', 'valid');
        })->count();

        $menunggu = Pendaftar::whereHas('verifikasi', function ($q) {
            $q->where(function ($x) {
                $x->where('verifikasi_berkas', 'pending')
                  ->orWhere('verifikasi_pembayaran', 'pending');
            });
        })->count();

        $ditolak = Pendaftar::whereHas('verifikasi', function ($q) {
            $q->where(function ($x) {
                $x->where('verifikasi_berkas', 'ditolak')
                  ->orWhere('verifikasi_pembayaran', 'ditolak');
            });
        })->count();

        return view('admin.data.index', compact(
            'pendaftar',
            'tahunAjaran',
            'gelombang',
            'total',
            'terverifikasi',
            'menunggu',
            'ditolak'
        ));
    }

    /**
     * =================================================
     * SHOW
     * =================================================
     * Detail pendaftar
     */
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

    /**
     * =================================================
     * EDIT
     * =================================================
     * Form edit data
     */
    public function edit($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);

        return view('admin.data.edit', compact('pendaftar'));
    }

    /**
     * =================================================
     * UPDATE
     * =================================================
     * Simpan perubahan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'status_santri' => 'required|in:mukim,non_mukim',
        ]);

        $pendaftar = Pendaftar::findOrFail($id);

        $pendaftar->update([
            'nama_lengkap'  => $request->nama_lengkap,
            'asal_sekolah'  => $request->asal_sekolah,
            'status_santri' => $request->status_santri,
        ]);

        return redirect()
            ->route('admin.data-pendaftar.index')
            ->with('success', 'Data pendaftar berhasil diperbarui');
    }

    /**
     * =================================================
     * DESTROY
     * =================================================
     * Hapus data
     */
    public function destroy($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);

        $pendaftar->delete();

        return back()->with('success', 'Data pendaftar berhasil dihapus');
    }
}
