<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\TahunAjaran;
use App\Models\Gelombang;
use App\Models\SekolahPilihan;
use App\Models\Unit;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $tahunAjaran = TahunAjaran::create([
            'id'              => Str::uuid(),
            'tahun'           => '2025/2026',
            'status'          => 'aktif',
            'tanggal_mulai'   => '2025-07-01',
            'tanggal_selesai' => '2026-06-30',
        ]);

        Gelombang::insert([
            [
                'id'               => Str::uuid(),
                'tahun_ajaran_id'  => $tahunAjaran->id,
                'nama_gelombang'   => 'Gelombang 1',
                'status'           => 'buka',
                'tanggal_mulai'    => '2025-01-01',
                'tanggal_selesai'  => '2025-02-28',
            ],
            [
                'id'               => Str::uuid(),
                'tahun_ajaran_id'  => $tahunAjaran->id,
                'nama_gelombang'   => 'Gelombang 2',
                'status'           => 'tutup',
                'tanggal_mulai'    => '2025-03-01',
                'tanggal_selesai'  => '2025-04-30',
            ],
        ]);

        SekolahPilihan::insert([
            [
                'id'            => Str::uuid(),
                'nama_sekolah'  => 'SMP Negeri 1',
                'jenjang'       => 'SLTP',
            ],
            [
                'id'            => Str::uuid(),
                'nama_sekolah'  => 'SMA Negeri 1',
                'jenjang'       => 'SLTA',
            ],
        ]);

        Unit::insert([
            [
                'id'        => Str::uuid(),
                'nama_unit' => 'Induk',
            ],
            [
                'id'        => Str::uuid(),
                'nama_unit' => 'Al-Risalah',
            ],
            [
                'id'        => Str::uuid(),
                'nama_unit' => 'Al-Mubtadien',
            ],
        ]);
    }
}
