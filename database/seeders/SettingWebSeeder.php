<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SettingWeb;

class SettingWebSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'setting_key'   => 'app_name',
                'setting_value' => 'SIGAP',
            ],
            [
                'setting_key'   => 'school_name',
                'setting_value' => 'PPDB MADRASAH',
            ],
            [
                'setting_key'   => 'school_subtitle',
                'setting_value' => 'Sistem Informasi Gerbang Pendaftaran',
            ],
            [
                'setting_key'   => 'academic_year',
                'setting_value' => '2025 / 2026',
            ],
            [
                'setting_key'   => 'logo',
                'setting_value' => 'assets/logo-sigap.svg',
            ],
            [
                'setting_key'   => 'menu_ppdb',
                'setting_value' => json_encode([
                    [
                        'type'  => 'link',
                        'title' => 'Form Pendaftaran',
                        'icon'  => 'fa-edit',
                        'url'   => 'pendaftaran',
                    ],
                    [
                        'type'    => 'accordion',
                        'title'   => 'Informasi PPDB',
                        'icon'    => 'fa-info-circle',
                        'content' => '<p>Informasi lengkap PPDB.</p>',
                    ],
                ]),
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
