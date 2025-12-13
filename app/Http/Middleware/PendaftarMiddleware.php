<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftarMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!auth::check()) {
            return redirect()->route('login');
        }
        
        if (auth::user()->role !== 'pendaftar') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login');
        }

        return $next($request);
    }
}
