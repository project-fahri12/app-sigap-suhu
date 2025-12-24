<?php

namespace App\Services\Ppdb;

use App\Models\Pembayaran;
use App\Models\Verifikasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentService
{
    public function shouldCreateNewPayment($pembayaran, $verifikasi)
    {
        return !$pembayaran || 
               ($verifikasi && $verifikasi->verifikasi_pembayaran === 'invalid') ||
               ($pembayaran->status === 'failed');
    }

    public function createPaymentRecord($pendaftarId, $orderId, $nominal, $snapToken)
    {
        return Pembayaran::create([
            'id'           => Str::uuid(),
            'pendaftar_id' => $pendaftarId,
            'order_id'     => $orderId,
            'nominal'      => $nominal,
            'snap_token'   => $snapToken,
            'status'       => 'pending',
        ]);
    }

    public function processCallback($data)
    {
        return DB::transaction(function () use ($data) {
            $pembayaran = Pembayaran::where('order_id', $data['order_id'])->first();
            if (!$pembayaran) return false;

            $status = $data['transaction_status'];

            if (in_array($status, ['settlement', 'capture'])) {
                $pembayaran->update([
                    'status' => 'success',
                    'payment_type' => $data['payment_type'],
                    'tanggal_bayar' => now()
                ]);

                Verifikasi::updateOrCreate(
                    ['pendaftar_id' => $pembayaran->pendaftar_id],
                    [
                        'verifikasi_pembayaran' => 'valid',
                        'catatan' => 'Diverifikasi otomatis oleh Sistem',
                    ]
                );
            } elseif (in_array($status, ['expire', 'cancel', 'deny'])) {
                $pembayaran->update(['status' => 'failed']);
            }

            return true;
        });
    }
}