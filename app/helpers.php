<?php

use App\Models\SettingWeb;

if (!function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        static $settings = null;

        if ($settings === null) {
            $settings = SettingWeb::pluck('setting_value', 'setting_key')->toArray();
        }

        return $settings[$key] ?? $default;
    }
}
