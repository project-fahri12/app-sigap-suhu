<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingWeb;
use App\Models\Gelombang;

class SettingWebController extends Controller
{
    public function index()
    {
        return view('admin.settingWeb.settingWeb');
    }

    public function update(Request $request)
    {

        if ($request->ppdb_status === 'buka') {
            $gelombangAktif = Gelombang::where('status', 'buka')->exists();

            if (!$gelombangAktif) {
                return back()->with('error',
                    'PPDB tidak bisa dibuka karena belum ada gelombang aktif.'
                );
            }
        }
        
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            SettingWeb::updateOrCreate(
                ['setting_key' => $key],
                ['setting_value' => $value]
            );
        }

        return back()->with('success', 'Setting berhasil diperbarui.');
    }
}
