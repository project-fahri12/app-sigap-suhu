<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;

class DashboardPendaftarController extends Controller
{
    public function index()
    {
        return view('pendaftar.dashboard');
    }
}
