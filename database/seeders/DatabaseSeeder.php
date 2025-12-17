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
        ]);

        /*
        |--------------------------------------------------------------------------
        | Tahun Ajaran
        |--------------------------------------------------------------------------
        */
        $tahunAjaran = TahunAjaran::create([
            'id' => Str::uuid(),
            'tahun' => '2025/2026',
            'status' => 'aktif',
            'tanggal_mulai' => '2025-07-01',
            'tanggal_selesai' => '2026-06-30',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Gelombang Pendaftaran
        |--------------------------------------------------------------------------
        */
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

        /*
        |--------------------------------------------------------------------------
        | Sekolah Pilihan
        |--------------------------------------------------------------------------
        */
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

        /*
        |--------------------------------------------------------------------------
        | Unit
        |--------------------------------------------------------------------------
        */
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

        /*
|--------------------------------------------------------------------------
| Setting Web (Sesuai UI Setting Site)
|--------------------------------------------------------------------------
*/
        $settings = [

            // ===============================
            // SETTING WEBSITE
            // ===============================
            [
                'setting_key' => 'app_name',
                'setting_value' => 'SIGAP',
            ],
            [
                'setting_key' => 'system_name',
                'setting_value' => 'Sistem Informasi Grebang Pendaftaran',
            ],
            [
                'setting_key' => 'logo_app',
                'setting_value' => 'assets/logo-sigap.svg',
            ],

            // ===============================
            // SETTING PPDB
            // ===============================
            [
                'setting_key' => 'ppdb_academic_year',
                'setting_value' => '2025/2026',
            ],
            [
                'setting_key' => 'ppdb_status',
                'setting_value' => 'buka',
            ],
            [
                'setting_key' => 'ppdb_active_wave',
                'setting_value' => 'Gelombang 1',
            ],
            [
                'setting_key' => 'ppdb_period',
                'setting_value' => '01 Januari 2025 - 28 Februari 2025',
            ],
            [
                'setting_key' => 'menu_ppdb',
                'setting_value' => json_encode([
                    [
                        'type' => 'link',
                        'title' => 'Form Pendaftaran',
                        'icon' => 'fa-edit',
                        'url' => 'pendaftaran',
                    ],
                    [
                        'type' => 'accordion',
                        'title' => 'Informasi PPDB',
                        'icon' => 'fa-info-circle',
                        'content' => '
                <ul>
                    <li>Tahun Ajaran: 2025 / 2026</li>
                    <li>Status PPDB: Dibuka</li>
                    <li>Gelombang Aktif: Gelombang 1</li>
                    <li>Periode: 01 Januari 2025 - 28 Februari 2025</li>
                </ul>
            ',
                    ],
                    [
                        'type' => 'accordion',
                        'title' => 'Syarat Pendaftaran',
                        'icon' => 'fa-list',
                        'content' => '
                <ul>
                    <li>Mengisi formulir pendaftaran</li>
                    <li>Upload pas foto</li>
                    <li>Upload kartu keluarga</li>
                    <li>Upload akta kelahiran</li>
                </ul>
            ',
                    ],
                    [
                        'type' => 'accordion',
                        'title' => 'Kontak Panitia',
                        'icon' => 'fa-phone',
                        'content' => '
                <p>WhatsApp Panitia: 0812-3456-7890</p>
            ',
                    ],
                ]),
            ],

            // ===============================
            // INFORMASI PONDOK PESANTREN
            // ===============================
            [
                'setting_key' => 'pondok_name',
                'setting_value' => 'Pondok Pesantren Al-Risalah',
            ],
            [
                'setting_key' => 'pondok_leader',
                'setting_value' => 'KH. Ahmad Fulan',
            ],
            [
                'setting_key' => 'pondok_address',
                'setting_value' => 'Jl. Pendidikan No. 123, Kabupaten Hikmah, Jawa Barat',
            ],
            [
                'setting_key' => 'pondok_phone',
                'setting_value' => '0812-3456-7890',
            ],
            [
                'setting_key' => 'pondok_email',
                'setting_value' => 'info@alrisalah.sch.id',
            ],
            [
                'setting_key' => 'pondok_website',
                'setting_value' => 'https://alrisalah.sch.id',
            ],

            // ===============================
            // KONTAK & MEDIA SOSIAL
            // ===============================
            [
                'setting_key' => 'contact_whatsapp',
                'setting_value' => '0812-3456-7890',
            ],
            [
                'setting_key' => 'social_instagram',
                'setting_value' => '@ponpesalrisalah',
            ],
            [
                'setting_key' => 'social_facebook',
                'setting_value' => 'Ponpes Al-Risalah',
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
