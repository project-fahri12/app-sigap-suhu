<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Gelombang;
use App\Models\Unit;
use App\Models\SekolahPilihan;
use App\Models\TahunAjaran;

class PendaftaranController extends Controller
{
    public function index() {
    
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
     * Memproses data formulir pendaftaran yang di-submit dan menyimpannya.
     */
    public function store(Request $request) {
        // --- VALIDASI DATA (Penting untuk disesuaikan dengan DB Schema Anda) ---
        $validatedData = $request->validate([
            // Validasi keberadaan ID harus dicek ke tabel yang benar
            'nik' => 'required|string|min:16|max:20|unique:pendaftar,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string|max:500',
            'gelombang_id' => 'required|exists:gelombang,id', 
            'unit_id' => 'required|exists:unit,id', 
            'sekolah_pilihan_id' => 'required|exists:sekolah_pilihan,id', 
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id', 
        ]);
        
        // --- LOGIKA PENYIMPANAN DATA UTAMA ---
        try {
            // 1. Simpan data ke tabel pendaftar
            // Asumsi: Anda memiliki Model Pendaftar
            $pendaftar = \App\Models\Pendaftar::create($validatedData);

            // 2. Generate Kode Pendaftaran unik
            // Logika ini harus memastikan kode unik dan berurutan
            $registration_code = $this->generateRegistrationCode($pendaftar, $validatedData);
            
            // 3. Update kode pendaftaran di record pendaftar
            $pendaftar->kode_pendaftaran = $registration_code;
            $pendaftar->save();

            // 4. Redirect ke halaman sukses dengan kode
            return redirect()->route('pendaftaran.success', ['code' => $registration_code])
                             ->with('success', 'Pendaftaran awal berhasil! Silakan simpan kode Anda.');

        } catch (\Exception $e) {
            Log::error('Gagal menyimpan pendaftaran awal: ' . $e->getMessage());
            // Redirect kembali dengan error
            return back()->withInput()->withErrors(['gagal' => 'Terjadi kesalahan sistem saat menyimpan data.']);
        }
    }

    /**
     * Contoh metode untuk menghasilkan kode pendaftaran unik
     */
    private function generateRegistrationCode($pendaftar, $data)
    {
        // Contoh sederhana: SG + Tahun + Unit ID + ID Pendaftar
        $tahun = TahunAjaran::find($data['tahun_ajaran_id'])->kode_tahun ?? date('Y');
        $unit = Unit::find($data['unit_id'])->kode_unit ?? $data['unit_id'];
        
        $urutan = str_pad($pendaftar->id, 5, '0', STR_PAD_LEFT);

        return "SG-{$tahun}-{$unit}-{$urutan}";
    }
}