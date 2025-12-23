<?php

namespace App\Services\PPDB;

use App\Models\Pembayaran;
use App\Models\Pendaftar;
use App\Models\Verifikasi;

class PembayaranService
{
    public function submit(Pendaftar $pendaftar, array $data): Pembayaran
    {
        // 1. Cegah double bayar
        $this->ensureNoPendingVerification($pendaftar);

        // 2. Simpan bukti transfer
        $filePath = $this->storeBukti($data['bukti_transfer']);

        // 3. Simpan pembayaran
        $pembayaran = Pembayaran::create([
            'pendaftar_id' => $pendaftar->id,
            'nominal' => $data['nominal'],
            'tanggal_bayar' => $data['tanggal_bayar'],
            'bukti_transfer' => $filePath,
        ]);

        // 4. Buat / update verifikasi
        $this->createOrUpdateVerifikasi($pendaftar);

        return $pembayaran;
    }

    private function ensureNoPendingVerification(Pendaftar $pendaftar): void
    {
        if (
            Verifikasi::where('pendaftar_id', $pendaftar->id)
                ->where('verifikasi_pembayaran', 'pending')
                ->exists()
        ) {
            throw new \DomainException(
                'Pembayaran masih menunggu verifikasi panitia.'
            );
        }
    }

    private function storeBukti($file): string
    {
        return $file->store('bukti-transfer', 'public');
    }

    private function createOrUpdateVerifikasi(Pendaftar $pendaftar): void
    {
        Verifikasi::updateOrCreate(
            ['pendaftar_id' => $pendaftar->id],
            [
                'verifikasi_pembayaran' => 'pending',
                'verifikasi_berkas' => 'belum',
            ]
        );
    }
}
