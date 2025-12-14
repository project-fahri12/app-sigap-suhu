<?php

namespace App\Http\Controllers\Home;

use App\Models\Unit;
use App\Models\User;
use App\Models\Gelombang;
use App\Models\Pendaftar;
use App\Models\TahunAjaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SekolahPilihan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\OrangTua; 
use App\Models\WaliSantri;

class PendaftaranController extends Controller
{
    /**
     * Form pendaftaran
     */
    public function index()
    {

        $gelombang_options = Gelombang::select('id', 'nama_gelombang')->where('status', 1)->orderBy('tanggal_mulai')->get();
        $unit_options = Unit::select('id', 'nama_unit')->get();
        $sekolah_options = SekolahPilihan::select('id', 'nama_sekolah')->get();
        $tahun_ajaran_options = TahunAjaran::select('id', 'tahun')->where('status', 'aktif')->orderBy('tahun', 'desc')->get();
        // dd($tahun_ajaran_options);

        // Cek jika ada masalah data tidak ditemukan
        if ($gelombang_options->isEmpty() || $tahun_ajaran_options->isEmpty()) {
            return view('home.pendaftaran_closed');
        }

        return view('home.form_santri', [
            'gelombang_options' => $gelombang_options,
            'unit_options' => $unit_options,
            'sekolah_options' => $sekolah_options,
            'tahun_ajaran_options' => $tahun_ajaran_options,
        ]);
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
            'alamat' => 'required|string|max:500', // Alamat Santri
            'gelombang_id' => 'required|exists:gelombang,id',
            'unit_id' => 'required|exists:unit,id',
            'sekolah_pilihan_id' => 'required|exists:sekolah_pilihan,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',

            // Data Orang Tua (Nama & Status Wajib)
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'no_hp_ayah' => 'nullable|string|max:20',
            'status_ayah' => 'required|in:hidup,meninggal,tidak_diketahui',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'no_hp_ibu' => 'nullable|string|max:20',
            'status_ibu' => 'required|in:hidup,meninggal,tidak_diketahui',
            'alamat_orang_tua' => 'nullable|string', // Alamat Orang Tua

            // Data Wali Santri (Opsional)
            'nama_wali' => 'nullable|string|max:255',
            'pekerjaan_wali' => 'nullable|string|max:255',
            'hubungan_wali' => 'nullable|in:ayah,ibu,paman,bibi,kakek,nenek,lainnya',
            'alamat_wali' => 'nullable|string',
            'no_hp_wali' => 'nullable|string|max:20',
        ]);
        
        $kodePendaftaran = null;

        DB::transaction(function () use ($validated, &$kodePendaftaran) {

            // =======================================================
            // 2. PROSES AKUN USER & PENDAFTAR
            // =======================================================

            // Generate kode pendaftaran
            // Mengubah format PSMB-Tahun-Random menjadi TAHUN_AKHIR_GELOMBANG+Random(4) agar lebih singkat
            $gelombangYear = substr($validated['tahun_ajaran_id'], 0, 4); 
            $kodePendaftaran = $gelombangYear . Str::random(4);

            // Password awal dari tanggal lahir (YYYYMMDD)
            $passwordAwal = date('Ymd', strtotime($validated['tanggal_lahir']));

            // Buat akun USER
            $user = User::create([
                'username' => $kodePendaftaran,
                'password' => Hash::make($passwordAwal),
                'role' => 'pendaftar',
            ]);

            // Filter data untuk tabel pendaftar
            $dataPendaftar = [
                'users_id' => $user->id,
                'kode_pendaftaran' => $kodePendaftaran,
                'nik' => $validated['nik'],
                'nama_lengkap' => $validated['nama_lengkap'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'alamat' => $validated['alamat'], // Alamat Santri
                'gelombang_id' => $validated['gelombang_id'],
                'unit_id' => $validated['unit_id'],
                'sekolah_pilihan_id' => $validated['sekolah_pilihan_id'],
                'tahun_ajaran_id' => $validated['tahun_ajaran_id'],
            ];

            $pendaftar = Pendaftar::create($dataPendaftar);
            $pendaftarId = $pendaftar->id;

            // =======================================================
            // 3. PROSES ORANG TUA
            // =======================================================

            $dataOrangTua = [
                'pendaftar_id' => $pendaftarId,
                'nama_ayah' => $validated['nama_ayah'],
                'pekerjaan_ayah' => $validated['pekerjaan_ayah'],
                'no_hp_ayah' => $validated['no_hp_ayah'],
                'status_ayah' => $validated['status_ayah'],
                'nama_ibu' => $validated['nama_ibu'],
                'pekerjaan_ibu' => $validated['pekerjaan_ibu'],
                'no_hp_ibu' => $validated['no_hp_ibu'],
                'status_ibu' => $validated['status_ibu'],
                'alamat_orang_tua' => $validated['alamat_orang_tua'] ?? $validated['alamat'], // Jika kosong, pakai alamat santri
            ];
            
            OrangTua::create($dataOrangTua);

            // =======================================================
            // 4. PROSES WALI SANTRI (Hanya jika nama_wali diisi)
            // =======================================================
            if (!empty($validated['nama_wali'])) {
                $dataWaliSantri = [
                    'pendaftar_id' => $pendaftarId,
                    'nama_wali' => $validated['nama_wali'],
                    'pekerjaan_wali' => $validated['pekerjaan_wali'],
                    'hubungan_wali' => $validated['hubungan_wali'] ?? 'lainnya',
                    'alamat_wali' => $validated['alamat_wali'],
                    'no_hp_wali' => $validated['no_hp_wali'],
                ];
                WaliSantri::create($dataWaliSantri);
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
