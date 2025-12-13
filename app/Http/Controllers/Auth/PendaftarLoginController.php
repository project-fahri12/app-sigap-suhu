<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftarLoginController extends Controller
{
    public function index()
    {
        return view('auth.login-pendaftar');
    }

    public function userLoginProses(Request $request)
    {

        // validasi input
        $request->validate([
            'kode' => 'required|string',
            'tanggal_lahir' => 'required|date',
        ]);

        $pass = date('Ymd', strtotime($request->tanggal_lahir));

        if (Auth::attempt([
            'username' => $request->kode,
            'password' => $pass,
        ])) {
            $request->session()->regenerate();

            return redirect()->route('pendaftar.dashboard');
        }

        return back()->withErrors([
            'login' => 'Kode pendaftaran atau tanggal lahir salah',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
