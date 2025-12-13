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

        return view('home.pendaftaran', [
            'gelombang_options' => $gelombang_options,
            'unit_options' => $unit_options,
            'sekolah_options' => $sekolah_options,
            'tahun_ajaran_options' => $tahun_ajaran_options,
        ]);
    }

    /**
     * Simpan pendaftaran awal
     */
    /**
     * Simpan pendaftaran awal
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|min:16|max:20|unique:pendaftar,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:500',
            'gelombang_id' => 'required|exists:gelombang,id',
            'unit_id' => 'required|exists:unit,id',
            'sekolah_pilihan_id' => 'required|exists:sekolah_pilihan,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
        ]);
        //
        DB::transaction(function () use ($validated, &$kodePendaftaran) {

            //Generate kode pendaftaran
            $kodePendaftaran = 'PSMB-'.now()->year.'-'.strtoupper(Str::random(6));

            //Password awal dari tanggal lahir
            $passwordAwal = date('Ymd', strtotime($validated['tanggal_lahir']));

            //Buat akun USER
            $user = User::create([
                'username' => $kodePendaftaran,
                'password' => Hash::make($passwordAwal),
                'role' => 'pendaftar',
            ]);

            //Buat data PENDAFTAR
            Pendaftar::create([
                ...$validated,
                'users_id' => $user->id,
                'kode_pendaftaran' => $kodePendaftaran,
            ]);
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
