<?php

namespace App\Services\Admin;

use App\Models\Pendaftar;
use App\Models\Verifikasi;

class VerifikasiService
{
    public function getAll()
    {
        return [
            'belum' => Pendaftar::with(['verifikasi', 'unit', 'berkas'])
                ->whereDoesntHave('verifikasi')
                ->orWhereHas('verifikasi', function ($q) {
                    $q->where('verifikasi_pembayaran', 'pending')
                      ->orWhere('verifikasi_berkas', 'pending');
                })
                ->get(),

            'lolos' => Pendaftar::with(['verifikasi', 'unit', 'berkas'])
                ->whereHas('verifikasi', function ($q) {
                    $q->where('verifikasi_pembayaran', 'valid')
                      ->where('verifikasi_berkas', 'valid');
                })
                ->get(),

            'ditolak' => Pendaftar::with(['verifikasi', 'unit', 'berkas'])
                ->whereHas('verifikasi', function ($q) {
                    $q->where('verifikasi_pembayaran', 'invalid')
                      ->orWhere('verifikasi_berkas', 'invalid');
                })
                ->get(),
        ];
    }

    public function update(Verifikasi $verifikasi, array $data)
    {
        // Pastikan berkas hanya bisa diverifikasi jika pembayaran valid
        if (!empty($data['status_file']) &&
            !in_array($data['status_file'], ['pending', 'belum']) &&
            $verifikasi->verifikasi_pembayaran !== 'valid') {
            throw new \DomainException('Verifikasi berkas hanya boleh setelah pembayaran VALID');
        }

        if (!empty($data['status_pay'])) {
            $verifikasi->verifikasi_pembayaran = $data['status_pay'];
        }

        if (!empty($data['status_file'])) {
            $verifikasi->verifikasi_berkas = $data['status_file'];
        }

        if (!empty($data['catatan'])) {
            $verifikasi->catatan = strtoupper($data['catatan']);
        }

        $verifikasi->diverifikasi_oleh = auth()->id();
        $verifikasi->tanggal = now()->toDateString();
        $verifikasi->save();

        return $verifikasi;
    }
}
