<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\SettingWeb;
use Illuminate\Http\Request;

class SettingWebController extends Controller
{
    public function index()
    {
        $tahunAjaranAktif = \App\Models\TahunAjaran::where('status', 'aktif')->first();
        $gelombangAktif = \App\Models\Gelombang::where('status', 1)->first();

return view('admin.settingWeb.settingWeb', compact(
    'tahunAjaranAktif',
    'gelombangAktif'
));
    }

    public function update(Request $request)
    {

        if ($request->ppdb_status === 'buka') {
            $gelombangAktif = Gelombang::where('status', 'buka')->exists();

            if (! $gelombangAktif) {
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
