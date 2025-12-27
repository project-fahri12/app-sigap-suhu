<?php
namespace App\Services\Ppdb;

use App\Models\User;
use App\Models\Pendaftar;
use App\Models\OrangTua;
use App\Models\WaliSantri;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PendaftaranService
{
    public function register(array $data): string
    {
        return DB::transaction(function () use ($data) {

            $kodePendaftaran = $this->generateKode($data);
            $passwordAwal = date('Ymd', strtotime($data['tanggal_lahir']));

            $user = User::create([
                'username' => $kodePendaftaran,
                'email' => strtolower($data['email']),
                'password' => Hash::make($passwordAwal),
                'role' => 'pendaftar',
            ]);

            $pendaftar = Pendaftar::create([
                ...$this->mapPendaftar($data),
                'users_id' => $user->id,
                'kode_pendaftaran' => $kodePendaftaran,
            ]);

            OrangTua::create([
                'pendaftar_id' => $pendaftar->id,
                ...$this->mapOrangTua($data),
            ]);

            if (!empty($data['nama_wali'])) {
                WaliSantri::create([
                    'pendaftar_id' => $pendaftar->id,
                    ...$this->mapWali($data),
                ]);
            }

            return $kodePendaftaran;
        });
    }

    protected function generateKode(array $data): string
    {
        return now()->format('Y') . strtoupper(Str::random(4));
    }

    protected function mapPendaftar(array $data): array
    {
        return [
            'nik' => $data['nik'],
            'nama_lengkap' => strtolower($data['nama_lengkap']),
            'tempat_lahir' => strtolower($data['tempat_lahir']),
            'tanggal_lahir' => $data['tanggal_lahir'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'status_santri' => $data['status_santri'],
            'asal_sekolah' => strtolower($data['asal_sekolah']),
            'provinsi' => strtolower($data['provinsi']),
            'kabupaten' => strtolower($data['kabupaten']),
            'kecamatan' => strtolower($data['kecamatan']),
            'desa' => strtolower($data['desa']),
            'rt' => $data['rt'],
            'rw' => $data['rw'],
            'alamat_detail' => strtolower($data['alamat_detail']),
            'gelombang_id' => $data['gelombang_id'],
            'unit_id' => $data['unit_id'],
            'sekolah_pilihan_id' => $data['sekolah_pilihan_id'],
            'tahun_ajaran_id' => $data['tahun_ajaran_id'],
        ];
    }

    protected function mapOrangTua(array $data): array
    {
        return [
            'nama_ayah'        => strtolower($data['nama_ayah']),
            'pekerjaan_ayah'  => strtolower($data['pekerjaan_ayah'] ?? ''),
            'status_ayah'     => $data['status_ayah'],

            'nama_ibu'        => strtolower($data['nama_ibu']),
            'pekerjaan_ibu'   => strtolower($data['pekerjaan_ibu'] ?? ''),
            'status_ibu'      => $data['status_ibu'],

            'alamat_orang_tua' => strtolower($data['alamat_orang_tua'] ?? $data['alamat_detail']),

            'email'               => strtolower($data['email']),
            'no_wa_utama'         => $data['no_wa_utama'],
            'pemilik_no_utama'    => $data['pemilik_no_utama'],
            'no_wa_cadangan'      => $data['no_wa_cadangan'] ?? null,
            'pemilik_no_cadangan' => $data['pemilik_no_cadangan'] ?? null,
        ];
    }


    protected function mapWali(array $data): array
    {
        return [
            'nama_wali' => strtolower($data['nama_wali']),
            'pekerjaan_wali' => strtolower($data['pekerjaan_wali'] ?? ''),
            'hubungan_wali' => $data['hubungan_wali'] ?? 'lainnya',
            'alamat_wali' => strtolower($data['alamat_wali'] ?? ''),
            'no_hp_wali' => $data['no_hp_wali'],
        ];
    }
}
