<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\SettingWeb;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua setting jadi key => value
        $settings = SettingWeb::pluck('setting_value', 'setting_key')->toArray();

        // Decode menu accordion (JSON)
        $menus = json_decode($settings['menu_ppdb'] ?? '[]', true);

        // Pastikan menus selalu array
        if (!is_array($menus)) {
            $menus = [];
        }

        return view('home.homePage', compact('settings', 'menus'));
    }
}
