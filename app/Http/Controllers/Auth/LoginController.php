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

    public function login(Request $request)
    {
        $kredensial = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($kredensial)) {
            
            $request->session()->regenerate();
            
            $pengguna = Auth::user();

            if($pengguna->role === 'admin'){
                return redirect()->route('admin.dashboard');
            }

            if ($pengguna->role === 'petugas') {
                return redirect()->route('petugas.dashboard');
            }

            Auth::logout();
            return back()->withErrors([
                'email' => 'ROLE PENGGUNA TIDAK VALID'
            ]);
        }

        return back()->withErrors([
            'email' => 'EMAIL ATAU PASSWORD SALAH'
        ])->withInput();
    }
}
