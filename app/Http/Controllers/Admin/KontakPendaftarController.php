<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrangTua;
use App\Models\Pendaftar;
use Illuminate\Http\Request;

class KontakPendaftarController extends Controller
{
    public function index() {
        $info = Pendaftar::With(['orangTua', 'verifikasi', 'unit', 'sekolahPilihan'])->get();
        return view('admin.kontak.index', compact('info'));
    }
}
