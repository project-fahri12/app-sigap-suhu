<?php

namespace App\Services\Admin;

use App\Models\Pendaftar;
use App\Models\Gelombang;
use App\Models\TahunAjaran;

class DataPendaftarService
{
    public function paginate(array $filters = [], int $perPage = 10)
    {
        $query = Pendaftar::with(['gelombang', 'tahunAjaran', 'verifikasi'])->latest();

        if (!empty($filters['tahun_ajaran'])) {
            $query->where('tahun_ajaran_id', $filters['tahun_ajaran']);
        }

        if (!empty($filters['gelombang'])) {
            $query->where('gelombang_id', $filters['gelombang']);
        }

        if (!empty($filters['status'])) {
            $query->whereHas('verifikasi', function($q) use ($filters) {
                switch ($filters['status']) {
                    case 'valid':
                        $q->where('verifikasi_berkas', 'valid')
                          ->where('verifikasi_pembayaran', 'valid');
                        break;
                    case 'pending':
                        $q->where(function($x){
                            $x->where('verifikasi_berkas', 'pending')
                              ->orWhere('verifikasi_pembayaran', 'pending');
                        });
                        break;
                    case 'ditolak':
                        $q->where(function($x){
                            $x->where('verifikasi_berkas', 'invalid')
                              ->orWhere('verifikasi_pembayaran', 'invalid');
                        });
                        break;
                }
            });
        }

        if (!empty($filters['search'])) {
            $query->where(function($q) use ($filters) {
                $q->where('nama_lengkap', 'like', '%'.$filters['search'].'%')
                  ->orWhere('nik', 'like', '%'.$filters['search'].'%')
                  ->orWhere('kode_pendaftaran', 'like', '%'.$filters['search'].'%');
            });
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function statistics()
    {
        $total = Pendaftar::count();

        $terverifikasi = Pendaftar::whereHas('verifikasi', function ($q) {
            $q->where('verifikasi_berkas', 'valid')
              ->where('verifikasi_pembayaran', 'valid');
        })->count();

        $menunggu = Pendaftar::whereHas('verifikasi', function ($q) {
            $q->where(function ($x) {
                $x->where('verifikasi_berkas', 'pending')
                  ->orWhere('verifikasi_pembayaran', 'pending');
            });
        })->count();

        $ditolak = Pendaftar::whereHas('verifikasi', function ($q) {
            $q->where(function ($x) {
                $x->where('verifikasi_berkas', 'invalid')
                  ->orWhere('verifikasi_pembayaran', 'invalid');
            });
        })->count();

        $tahunAjaran = TahunAjaran::orderBy('tahun', 'desc')->get();
        $gelombang = Gelombang::orderBy('nama_gelombang')->get();

        return compact('total', 'terverifikasi', 'menunggu', 'ditolak', 'tahunAjaran', 'gelombang');
    }

    public function update($id, array $data)
    {
        $pendaftar = Pendaftar::findOrFail($id);

        $pendaftar->update($data);

        return $pendaftar;
    }
}
