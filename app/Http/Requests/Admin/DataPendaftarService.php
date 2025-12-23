<?php

namespace App\Services\Admin;

use App\Models\OrangTua;
use App\Models\Gelombang;
use App\Models\Pendaftar;
use App\Models\WaliSantri;
use App\Models\tahunAjaran;
use Illuminate\Support\Facades\DB;

class DataPendaftarService
{

    public function filters(): array
{
    return [
        'tahunAjaran' => tahunAjaran::orderBy('tahun', 'desc')->get(),
        'gelombang'   => Gelombang::orderBy('nama_gelombang')->get(),
    ];
}

    public function paginate(array $filter)
    {
        $query = Pendaftar::with([
            'gelombang',
            'tahunAjaran',
            'verifikasi',
        ])->latest();

        if (!empty($filter['tahun_ajaran'])) {
            $query->where('tahun_ajaran_id', $filter['tahun_ajaran']);
        }

        if (!empty($filter['gelombang'])) {
            $query->where('gelombang_id', $filter['gelombang']);
        }

        if (!empty($filter['status'])) {
            match ($filter['status']) {
                'valid' => $query->whereHas('verifikasi', fn ($q) =>
                    $q->where('verifikasi_berkas', 'valid')
                      ->where('verifikasi_pembayaran', 'valid')
                ),
                'pending' => $query->whereHas('verifikasi', fn ($q) =>
                    $q->whereIn('verifikasi_berkas', ['pending'])
                      ->orWhereIn('verifikasi_pembayaran', ['pending'])
                ),
                'ditolak' => $query->whereHas('verifikasi', fn ($q) =>
                    $q->whereIn('verifikasi_berkas', ['invalid', 'ditolak'])
                      ->orWhereIn('verifikasi_pembayaran', ['invalid', 'ditolak'])
                ),
                default => null,
            };
        }

        if (!empty($filter['search'])) {
            $query->where(function ($q) use ($filter) {
                $q->where('nama_lengkap', 'like', "%{$filter['search']}%")
                  ->orWhere('nik', 'like', "%{$filter['search']}%")
                  ->orWhere('kode_pendaftaran', 'like', "%{$filter['search']}%");
            });
        }

        return $query->paginate(10)->withQueryString();
    }

    public function statistics(): array
    {
        return [
            'total' => Pendaftar::count(),

            'terverifikasi' => Pendaftar::whereHas('verifikasi', fn ($q) =>
                $q->where('verifikasi_berkas', 'valid')
                  ->where('verifikasi_pembayaran', 'valid')
            )->count(),

            'menunggu' => Pendaftar::whereHas('verifikasi', fn ($q) =>
                $q->where('verifikasi_berkas', 'pending')
                  ->orWhere('verifikasi_pembayaran', 'pending')
            )->count(),

            'ditolak' => Pendaftar::whereHas('verifikasi', fn ($q) =>
                $q->whereIn('verifikasi_berkas', ['invalid', 'ditolak'])
                  ->orWhereIn('verifikasi_pembayaran', ['invalid', 'ditolak'])
            )->count(),
        ];
    }

    public function update(string $id, array $data): void
    {
        DB::transaction(function () use ($id, $data) {

            $pendaftar = Pendaftar::findOrFail($id);

            $pendaftar->update([
                'nik' => $data['nik'],
                'nama_lengkap' => strtolower($data['nama_lengkap']),
                'tempat_lahir' => strtolower($data['tempat_lahir']),
                'tanggal_lahir' => $data['tanggal_lahir'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'status_santri' => $data['status_santri'],
                'asal_sekolah' => strtolower($data['asal_sekolah'] ?? ''),

                'provinsi' => strtolower($data['provinsi']),
                'kabupaten' => strtolower($data['kabupaten']),
                'kecamatan' => strtolower($data['kecamatan']),
                'desa' => strtolower($data['desa']),
                'rt' => $data['rt'] ?? null,
                'rw' => $data['rw'] ?? null,
                'alamat_detail' => strtolower($data['alamat_detail']),
            ]);

            OrangTua::updateOrCreate(
                ['pendaftar_id' => $pendaftar->id],
                [
                    'nama_ayah' => strtolower($data['nama_ayah'] ?? ''),
                    'pekerjaan_ayah' => strtolower($data['pekerjaan_ayah'] ?? ''),
                    'no_hp_ayah' => $data['no_hp_ayah'] ?? null,
                    'status_ayah' => $data['status_ayah'] ?? null,

                    'nama_ibu' => strtolower($data['nama_ibu'] ?? ''),
                    'pekerjaan_ibu' => strtolower($data['pekerjaan_ibu'] ?? ''),
                    'no_hp_ibu' => $data['no_hp_ibu'] ?? null,
                    'status_ibu' => $data['status_ibu'] ?? null,
                    'alamat_orang_tua' => strtolower($data['alamat_orang_tua'] ?? ''),
                ]
            );

            if (!empty($data['nama_wali'])) {
                WaliSantri::updateOrCreate(
                    ['pendaftar_id' => $pendaftar->id],
                    [
                        'nama_wali' => strtolower($data['nama_wali']),
                        'pekerjaan_wali' => strtolower($data['pekerjaan_wali'] ?? ''),
                        'hubungan_wali' => $data['hubungan_wali'] ?? 'lainnya',
                        'alamat_wali' => strtolower($data['alamat_wali'] ?? ''),
                        'no_hp_wali' => $data['no_hp_wali'] ?? null,
                    ]
                );
            }
        });
    }
}
