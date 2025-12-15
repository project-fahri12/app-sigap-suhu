<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftar;
use App\Models\OrangTua;
use App\Models\WaliSantri;
use App\Models\Berkas;

class IdentitasSantriController extends Controller
{
    public function index()
    {
        $pendaftar = Pendaftar::where('users_id', Auth::id())->firstOrFail();

        $orangTua = OrangTua::where('pendaftar_id', $pendaftar->id)->first();
        $wali     = WaliSantri::where('pendaftar_id', $pendaftar->id)->first();
        $berkas   = Berkas::where('pendaftar_id', $pendaftar->id)->latest()->first();

        return view('pendaftar.identitas-santri', compact(
            'pendaftar',
            'orangTua',
            'wali',
            'berkas'
        ));
    }
}
