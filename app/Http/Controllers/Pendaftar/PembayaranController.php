<?php

namespace App\Http\Controllers\Pendaftar;

use App\Models\Pendaftar;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePembayaranRequest;
use App\Services\PPDB\PembayaranService;

class PembayaranController extends Controller
{
    // public function index()
    // {
    //     $pendaftar = Pendaftar::where('users_id', Auth::id())->firstOrFail();

    //     $pembayaran = $pendaftar->pembayaran()
    //         ->latest()
    //         ->first();

    //     return view('pendaftar.pembayaran.index', compact(
    //         'pendaftar',
    //         'pembayaran'
    //     ));
    // }

    public function store(StorePembayaranRequest $request, PembayaranService $service) {
        try {
            $pendaftar = Pendaftar::where('users_id', Auth::id())->firstOrFail();

            $service->submit($pendaftar,$request->validated());

            return back()->with('success', 'Pembayaran berhasil dikirim.');

        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage()
            );
        }
    }
}
