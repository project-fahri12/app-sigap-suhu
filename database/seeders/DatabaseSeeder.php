<?php

namespace Database\Seeders;

use App\Models\Gelombang;
use App\Models\SekolahPilihan;
use App\Models\SettingWeb;
use App\Models\TahunAjaran;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        User::create([
            'id' => (string) Str::uuid(),
            'username' => 'admin fahri',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12121212'),
            'role' => 'admin',
            'status_aktif' => 'aktif',
            'email_verified_at' => now(),
            
            'id' => (string) Str::uuid(),
            'username' => 'petugas fahri',
            'email' => 'petugas@petugas.com',
            'password' => Hash::make('12121212'),
            'role' => 'petugas',
            'status_aktif' => 'aktif',
            'email_verified_at' => now(),


        ]);

       
        $tahunAjaran = TahunAjaran::create([
            'id' => Str::uuid(),
            'tahun' => '2025/2026',
            'status' => 'aktif',
            'tanggal_mulai' => '2025-07-01',
            'tanggal_selesai' => '2026-06-30',
        ]);

       
        Gelombang::insert([
            [
                'id' => Str::uuid(),
                'tahun_ajaran_id' => $tahunAjaran->id,
                'nama_gelombang' => 'Gelombang 1',
                'status' => 'buka',
                'tanggal_mulai' => '2025-01-01',
                'tanggal_selesai' => '2025-02-28',
            ],
            [
                'id' => Str::uuid(),
                'tahun_ajaran_id' => $tahunAjaran->id,
                'nama_gelombang' => 'Gelombang 2',
                'status' => 'tutup',
                'tanggal_mulai' => '2025-03-01',
                'tanggal_selesai' => '2025-04-30',
            ],
        ]);

        
        SekolahPilihan::insert([
            [
                'id' => Str::uuid(),
                'nama_sekolah' => 'SMP Negeri 1',
                'jenjang' => 'SLTP',
            ],
            [
                'id' => Str::uuid(),
                'nama_sekolah' => 'SMA Negeri 1',
                'jenjang' => 'SLTA',
            ],
        ]);

       
        Unit::insert([
            [
                'id' => Str::uuid(),
                'nama_unit' => 'Induk',
            ],
            [
                'id' => Str::uuid(),
                'nama_unit' => 'Al-Risalah',
            ],
            [
                'id' => Str::uuid(),
                'nama_unit' => 'Al-Mubtadien',
            ],
        ]);

     
       $settings = [
    [
        'setting_key' => 'nama_sistem',
        'setting_value' => 'SIGAP',
    ],
    [
        'setting_key' => 'nama_lembaga',
        'setting_value' => 'NAMA LEMBAGA',
    ],
    [
        'setting_key' => 'versi_app',
        'setting_value' => '1.0.0',
    ],
    [
        'setting_key' => 'logo_lembaga',
        'setting_value' => 'assets/logo-sigap-white.png',
    ],
    [
        'setting_key' => 'icon',
        'setting_value' => 'assets/favicon.ico',
    ],
    [
        'setting_key' => 'maintenance_mode',
        'setting_value' => 'false',
    ],

    
    [
        'setting_key' => 'status_ppdb',
        'setting_value' => 'buka',
    ],
    [
        'setting_key' => 'ppdb_auto_close',
        'setting_value' => 'false',
    ],
    [
        'setting_key' => 'biaya_pendaftaran',
        'setting_value' => '150000',
    ],
    [
        'setting_key' => 'menu_ppdb',
        'setting_value' => json_encode([
            [
                'type' => 'link',
                'title' => 'Pendaftaran',
                'icon' => 'fa-edit',
                'url' => 'pendaftaran',
            ],
            [
                'type' => 'accordion',
                'title' => 'Informasi PPDB',
                'icon' => 'fa-info-circle',
                'content' => '
                <ul>
                    <li>Tahun Ajaran: 2025/2026</li>
                    <li>Status PPDB: Dibuka</li>
                    <li>Gelombang Aktif: Gelombang 1</li>
                    <li>Periode: 01 Januari 2025 - 28 Februari 2025</li>
                </ul>
            ',
            ],
        ]),
    ],
    [
        'setting_key' => 'tahun_ajaran',
        'setting_value' => '2025/2026',
    ],
    [
        'setting_key' => 'gelombang_aktif',
        'setting_value' => 'Gelombang 1',
    ],

    [
        'setting_key' => 'kontak_tlp',
        'setting_value' => '0351xxxxxx',
    ],
    [
        'setting_key' => 'kontak_whatsapp',
        'setting_value' => '08123456789',
    ],
    [
        'setting_key' => 'email',
        'setting_value' => 'admin@pesantren.id',
    ],
    [
        'setting_key' => 'alamat',
        'setting_value' => 'Madiun, Jawa Timur',
    ],
    [
        'setting_key' => 'lokasi_map',
        'setting_value' => 'https://maps.google.com/...',
    ],
    [
        'setting_key' => 'instagram',
        'setting_value' => 'https://instagram.com/pesantren',
    ],
    [
        'setting_key' => 'facebook',
        'setting_value' => 'https://facebook.com/pesantren',
    ],
    [
        'setting_key' => 'youtube',
        'setting_value' => 'https://youtube.com/pesantren',
    ],
    [
        'setting_key' => 'tiktok',
        'setting_value' => 'https://tiktok.com/@pesantren',
    ],

   
    [
        'setting_key' => 'merchant_id',
        'setting_value' => 'dddddd',
    ],
    [
        'setting_key' => 'client_key',
        'setting_value' => 'ssssssad',
    ],
    [
        'setting_key' => 'server_key',
        'setting_value' => 'SB-Mid-server-XXXX',
    ],
    [
        'setting_key' => 'alamat_lembaga',
        'setting_value' => 'Jl. manggis no 121',
    ],
];

foreach ($settings as $setting) {
    SettingWeb::updateOrCreate(
        ['setting_key' => $setting['setting_key']],
        ['setting_value' => $setting['setting_value']]
    );
}


    }
}
