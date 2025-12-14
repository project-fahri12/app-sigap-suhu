<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua setting jadi key => value
        $settings = DB::table('setting_web')
            ->pluck('setting_value', 'setting_key');

        // Decode menu accordion (JSON)
        $menus = json_decode($settings['menu_ppdb'] ?? '[]', true);

        return view('home.homePage', compact('settings', 'menus'));
    }
}
