<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login admin
     */
    public function show()
    {
        $settings = DB::table('setting_web')
            ->pluck('setting_value', 'setting_key');

        return view('auth.login-admin', compact('settings'));
    }

    /**
     * Proses login admin
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Attempt login
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // OPTIONAL: cek role admin (SANGAT DISARANKAN)
            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'ANDA TIDAK MEMILIKI AKSES ADMIN'
                ]);
            }

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'EMAIL ATAU PASSWORD SALAH'
        ])->withInput();
    }
}
