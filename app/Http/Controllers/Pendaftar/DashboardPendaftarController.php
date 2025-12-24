<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use App\Http\Requests\MidtransCallbackRequest;
use App\Models\Pembayaran;
use App\Models\Pendaftar;
use App\Models\Verifikasi;
use App\Services\Ppdb\MidtransService;
use App\Services\Ppdb\PaymentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class DashboardPendaftarController extends Controller
{
    protected $midtransService;
    protected $paymentService;

    public function __construct(MidtransService $midtransService, PaymentService $paymentService)
    {
        $this->midtransService = $midtransService;
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        $santri = Pendaftar::with('orangTua')->where('users_id', Auth::id())->firstOrFail();
        $verifikasi = Verifikasi::where('pendaftar_id', $santri->id)->first();
        $pembayaran = Pembayaran::where('pendaftar_id', $santri->id)->latest()->first();

        $snapToken = $pembayaran->snap_token ?? null;

        if ($this->paymentService->shouldCreateNewPayment($pembayaran, $verifikasi)) {
            try {
                $orderId = 'SIGAP-' . Str::upper(Str::random(5)) . '-' . $santri->id;
                $nominal = (int) setting('biaya_pendaftaran') ?? 150000;

                $params = [
                    'transaction_details' => ['order_id' => $orderId, 'gross_amount' => $nominal],
                    'customer_details' => [
                        'first_name' => $santri->nama_lengkap,
                        'email' => Auth::user()->email,
                        'phone' => $santri->orangTua->no_hp_ayah ?? '',
                    ],
                ];

                $snapToken = $this->midtransService->createSnapToken($params);
                $pembayaran = $this->paymentService->createPaymentRecord($santri->id, $orderId, $nominal, $snapToken);

            } catch (Exception $e) {
                Log::error("Midtrans Error: " . $e->getMessage());
            }
        }

        return view('pendaftar.dashboard', compact('santri', 'pembayaran', 'verifikasi', 'snapToken'));
    }

    public function callback(MidtransCallbackRequest $request)
    {
        // 1. Verifikasi Signature via Service
        $isValid = $this->midtransService->verifySignature(
            $request->order_id, 
            $request->status_code, 
            $request->gross_amount, 
            $request->signature_key
        );

        if (!$isValid) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // 2. Proses Logika Pembayaran via Service
        $processed = $this->paymentService->processCallback($request->all());

        if (!$processed) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json(['message' => 'Success'], 200);
    }
}