<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PendaftarLoginController extends Controller
{
    public function index() {
        return view('auth.login-pendaftar');
    }

    public function userLoginProses() {
        dd(Request()->all());
    }
}
