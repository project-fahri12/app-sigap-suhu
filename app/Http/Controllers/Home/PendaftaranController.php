<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\OrangTua;
use App\Models\Pendaftar;
use App\Models\SekolahPilihan;
use App\Models\TahunAjaran;
use App\Models\Unit;
use App\Models\User;
use App\Models\WaliSantri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    /**
     * Form pendaftaran
     */
    public function index()
    {
        $tahun_ajaran = TahunAjaran::select('id', 'tahun')
            ->where('status', 'aktif')
            ->orderBy('tahun', 'desc')
            ->first();

        $gelombang = Gelombang::select('id', 'nama_gelombang')
            ->where('status', 1)
            ->orderBy('tanggal_mulai')
            ->first();

        $unit_options = Unit::select('id', 'nama_unit')->get();
        $sekolah_options = SekolahPilihan::select('id', 'nama_sekolah')->get();

        // Jika pendaftaran ditutup
        if (setting('ppdb_status') == 'tutup') {
            return view('home.pendaftaran_closed');
        }

        return view('home.form_santri', compact(
            'tahun_ajaran',
            'gelombang',
            'unit_options',
            'sekolah_options'
        ));
    }

    public function store(Request $request)
    {
        // =======================================================
        // 1. VALIDASI SEMUA DATA DARI 3 TABEL
        // =======================================================
        $validated = $request->validate([
            // Data Pendaftar (Wajib diisi)
            'nik' => 'required|string|min:16|max:20|unique:pendaftar,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'status_santri' => 'required|in:mukim,non_mukim',
            'asal_sekolah' => 'required|max:100',
            'provinsi' => 'required|string',
            'kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'desa' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'alamat_detail' => 'required|string|max:255',
            'gelombang_id' => 'required|exists:gelombang,id',
            'unit_id' => 'required|exists:unit,id',
            'sekolah_pilihan_id' => 'required|exists:sekolah_pilihan,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',

            // Data Orang Tua
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'no_hp_ayah' => 'nullable|string|max:20',
            'status_ayah' => 'required|in:hidup,meninggal,tidak_diketahui',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'no_hp_ibu' => 'nullable|string|max:20',
            'status_ibu' => 'required|in:hidup,meninggal,tidak_diketahui',
            'alamat_orang_tua' => 'nullable|string',

            // Data Wali
            'nama_wali' => 'nullable|string|max:255',
            'pekerjaan_wali' => 'nullable|string|max:255',
            'hubungan_wali' => 'nullable|in:ayah,ibu,paman,bibi,kakek,nenek,lainnya',
            'alamat_wali' => 'nullable|string',
            'no_hp_wali' => 'nullable|string|max:20',
        ]);

        // =======================================================
        // 1.1 NORMALISASI DATA STRING → LOWERCASE (AMAN)
        // =======================================================
        $textFields = [
            // pendaftar
            'nama_lengkap',
            'tempat_lahir',
            'asal_sekolah',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'desa',
            'alamat_detail',

            // orang tua
            'nama_ayah',
            'pekerjaan_ayah',
            'nama_ibu',
            'pekerjaan_ibu',
            'alamat_orang_tua',

            // wali
            'nama_wali',
            'pekerjaan_wali',
            'alamat_wali',
        ];

        foreach ($textFields as $field) {
            if (! empty($validated[$field])) {
                $validated[$field] = mb_strtolower(trim($validated[$field]));
            }
        }

        $kodePendaftaran = null;

        DB::transaction(function () use ($validated, &$kodePendaftaran) {

            // =======================================================
            // 2. PROSES AKUN USER & PENDAFTAR
            // =======================================================

            $gelombangYear = substr($validated['tahun_ajaran_id'], 0, 4);
            $kodePendaftaran = $gelombangYear.Str::random(4);

            $passwordAwal = date('Ymd', strtotime($validated['tanggal_lahir']));

            $user = User::create([
                'username' => $kodePendaftaran,
                'password' => Hash::make($passwordAwal),
                'role' => 'pendaftar',
            ]);

            $dataPendaftar = [
                'users_id' => $user->id,
                'kode_pendaftaran' => $kodePendaftaran,
                'nik' => $validated['nik'],
                'nama_lengkap' => $validated['nama_lengkap'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'status_santri' => $validated['status_santri'],
                'asal_sekolah' => $validated['asal_sekolah'],
                'provinsi' => $validated['provinsi'],
                'kabupaten' => $validated['kabupaten'],
                'kecamatan' => $validated['kecamatan'],
                'desa' => $validated['desa'],
                'rt' => $validated['rt'],
                'rw' => $validated['rw'],
                'alamat_detail' => $validated['alamat_detail'],
                'gelombang_id' => $validated['gelombang_id'],
                'unit_id' => $validated['unit_id'],
                'sekolah_pilihan_id' => $validated['sekolah_pilihan_id'],
                'tahun_ajaran_id' => $validated['tahun_ajaran_id'],
            ];

            $pendaftar = Pendaftar::create($dataPendaftar);

            // =======================================================
            // 3. PROSES ORANG TUA
            // =======================================================
            OrangTua::create([
                'pendaftar_id' => $pendaftar->id,
                'nama_ayah' => $validated['nama_ayah'],
                'pekerjaan_ayah' => $validated['pekerjaan_ayah'],
                'no_hp_ayah' => $validated['no_hp_ayah'],
                'status_ayah' => $validated['status_ayah'],
                'nama_ibu' => $validated['nama_ibu'],
                'pekerjaan_ibu' => $validated['pekerjaan_ibu'],
                'no_hp_ibu' => $validated['no_hp_ibu'],
                'status_ibu' => $validated['status_ibu'],
                'alamat_orang_tua' => $validated['alamat_orang_tua']
                    ?? $validated['alamat_detail'],
            ]);

            // =======================================================
            // 4. PROSES WALI (JIKA ADA)
            // =======================================================
            if (! empty($validated['nama_wali'])) {
                WaliSantri::create([
                    'pendaftar_id' => $pendaftar->id,
                    'nama_wali' => $validated['nama_wali'],
                    'pekerjaan_wali' => $validated['pekerjaan_wali'],
                    'hubungan_wali' => $validated['hubungan_wali'] ?? 'lainnya',
                    'alamat_wali' => $validated['alamat_wali'],
                    'no_hp_wali' => $validated['no_hp_wali'],
                ]);
            }
        });

        return redirect()
            ->route('pendaftaran.sukses')
            ->with('registration_code', $kodePendaftaran);
    }

    /**
     * Halaman sukses (protected by session)
     */
    public function success()
    {
        // dd(session()->all());

        $registrationCode = session('registration_code');

        if (! $registrationCode) {
            return redirect()
                ->route('pendaftaran.index')
                ->with('error', 'Akses tidak sah ke halaman sukses. Silakan ulangi pendaftaran.');
        }

        return view('home.kodePendaftaran', [
            'registration_code' => $registrationCode,
        ]);
    }
}
