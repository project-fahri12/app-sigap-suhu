<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftar;
use App\Models\Verifikasi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {

            // Default biar aman
            $verifikasi = null;

            if (Auth::check() && Auth::user()->role === 'pendaftar') {

                $pendaftar = Pendaftar::where('users_id', Auth::id())->first();

                if ($pendaftar) {
                    $verifikasi = Verifikasi::where('pendaftar_id', $pendaftar->id)->first();
                }
            }

            // Kirim ke SEMUA view
            $view->with('verifikasi', $verifikasi);
        });
    }
}
