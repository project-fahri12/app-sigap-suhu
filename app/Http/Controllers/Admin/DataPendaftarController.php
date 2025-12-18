<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrangTua;
use App\Models\Gelombang;
use App\Models\Pendaftar;
use App\Models\WaliSantri;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
    $pendaftar = Pendaftar::with(['orangTua', 'waliSantri'])->findOrFail($id);

    return view('admin.data.edit', compact('pendaftar'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        // ================= PENDAFTAR =================
        'nik' => 'required|string|min:16|max:20',
        'nama_lengkap' => 'required|string|max:255',
        'tempat_lahir' => 'required|string|max:100',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:L,P',
        'status_santri' => 'required|in:mukim,non_mukim',
        'asal_sekolah' => 'nullable|string|max:50',

        'provinsi' => 'required|string|max:25',
        'kabupaten' => 'required|string|max:25',
        'kecamatan' => 'required|string|max:25',
        'desa' => 'required|string|max:25',
        'rt' => 'nullable|string|max:3',
        'rw' => 'nullable|string|max:3',
        'alamat_detail' => 'required|string|max:255',

        // ================= ORANG TUA =================
        'nama_ayah' => 'nullable|string|max:255',
        'pekerjaan_ayah' => 'nullable|string|max:255',
        'no_hp_ayah' => 'nullable|string|max:20',
        'status_ayah' => 'nullable|in:hidup,meninggal,tidak_diketahui',

        'nama_ibu' => 'nullable|string|max:255',
        'pekerjaan_ibu' => 'nullable|string|max:255',
        'no_hp_ibu' => 'nullable|string|max:20',
        'status_ibu' => 'nullable|in:hidup,meninggal,tidak_diketahui',
        'alamat_orang_tua' => 'nullable|string',

        // ================= WALI =================
        'nama_wali' => 'nullable|string|max:255',
        'pekerjaan_wali' => 'nullable|string|max:255',
        'hubungan_wali' => 'nullable|in:ayah,ibu,paman,bibi,kakek,nenek,lainnya',
        'alamat_wali' => 'nullable|string',
        'no_hp_wali' => 'nullable|string|max:20',
    ]);

    DB::transaction(function () use ($validated, $id) {

        // ================= UPDATE PENDAFTAR =================
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->update([
            'nik' => $validated['nik'],
            'nama_lengkap' => strtolower($validated['nama_lengkap']),
            'tempat_lahir' => strtolower($validated['tempat_lahir']),
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'status_santri' => $validated['status_santri'],
            'asal_sekolah' => strtolower($validated['asal_sekolah'] ?? ''),

            'provinsi' => strtolower($validated['provinsi']),
            'kabupaten' => strtolower($validated['kabupaten']),
            'kecamatan' => strtolower($validated['kecamatan']),
            'desa' => strtolower($validated['desa']),
            'rt' => $validated['rt'],
            'rw' => $validated['rw'],
            'alamat_detail' => strtolower($validated['alamat_detail']),
        ]);

        // ================= UPDATE / CREATE ORANG TUA =================
        OrangTua::updateOrCreate(
            ['pendaftar_id' => $pendaftar->id],
            [
                'nama_ayah' => strtolower($validated['nama_ayah'] ?? ''),
                'pekerjaan_ayah' => strtolower($validated['pekerjaan_ayah'] ?? ''),
                'no_hp_ayah' => $validated['no_hp_ayah'],
                'status_ayah' => $validated['status_ayah'],

                'nama_ibu' => strtolower($validated['nama_ibu'] ?? ''),
                'pekerjaan_ibu' => strtolower($validated['pekerjaan_ibu'] ?? ''),
                'no_hp_ibu' => $validated['no_hp_ibu'],
                'status_ibu' => $validated['status_ibu'],
                'alamat_orang_tua' => strtolower($validated['alamat_orang_tua'] ?? ''),
            ]
        );

        // ================= UPDATE / CREATE WALI =================
        if (!empty($validated['nama_wali'])) {
            WaliSantri::updateOrCreate(
                ['pendaftar_id' => $pendaftar->id],
                [
                    'nama_wali' => strtolower($validated['nama_wali']),
                    'pekerjaan_wali' => strtolower($validated['pekerjaan_wali'] ?? ''),
                    'hubungan_wali' => $validated['hubungan_wali'] ?? 'lainnya',
                    'alamat_wali' => strtolower($validated['alamat_wali'] ?? ''),
                    'no_hp_wali' => $validated['no_hp_wali'],
                ]
            );
        }
    });

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
