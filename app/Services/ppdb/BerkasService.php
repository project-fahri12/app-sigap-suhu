<?php

namespace App\Services\Ppdb;

use App\Models\Berkas;
use App\Models\Pendaftar;
use App\Models\Verifikasi;
use Illuminate\Support\Str;

class BerkasService
{
    public function upload(Pendaftar $pendaftar, array $data): Berkas
    {
        $this->ensureCanUpload($pendaftar);

        $pdfPath  = $this->storePdf($pendaftar, $data['file']);
        $fotoPath = $this->storeFoto($pendaftar, $data['foto']);

        $berkas = Berkas::create([
            'id' => Str::uuid(),
            'pendaftar_id' => $pendaftar->id,
            'file_path' => $pdfPath,
            'foto_path' => $fotoPath,
            'keterangan' => 'Upload awal',
        ]);

        $this->updateVerifikasi($pendaftar);

        return $berkas;
    }


    private function ensureCanUpload(Pendaftar $pendaftar): void
    {
        if (
            Verifikasi::where('pendaftar_id', $pendaftar->id)
                ->where('verifikasi_berkas', 'pending')
                ->exists()
        ) {
            throw new \DomainException(
                'Berkas masih menunggu verifikasi panitia.'
            );
        }
    }

    private function storePdf(Pendaftar $pendaftar, $file): string
    {
        return $file->storeAs(
            'berkas_pendaftar',
            'berkas_'.$pendaftar->id.'_'.time().'.pdf',
            'public'
        );
    }

    private function storeFoto(Pendaftar $pendaftar, $file): string
    {
        return $file->storeAs(
            'foto_pendaftar',
            'foto_'.$pendaftar->id.'_'.time().'.'.$file->extension(),
            'public'
        );
    }

    private function updateVerifikasi(Pendaftar $pendaftar): void
    {
        Verifikasi::updateOrCreate(
            ['pendaftar_id' => $pendaftar->id],
            [
                'verifikasi_berkas' => 'pending',
                'tanggal' => now(),
            ]
        );
    }
}
