<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use UuidTrait;

    protected $table = 'pendaftar';

    protected $fillable = [
        'users_id',
        'kode_pendaftaran',
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_santri',

        // ===== ALAMAT BERANTAI =====
        'provinsi',
        'kabupaten',
        'kecamatan',
        'desa',
        'rt',
        'rw',
        'alamat_detail',

        'asal_sekolah',
        'gelombang_id',
        'tahun_ajaran_id',
        'sekolah_pilihan_id',
        'unit_id',
    ];

    /* ========== RELASI ========== */

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function gelombang()
    {
        return $this->belongsTo(Gelombang::class);
    }

    public function sekolahPilihan()
    {
        return $this->belongsTo(SekolahPilihan::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function orangTua()
    {
        return $this->hasOne(OrangTua::class);
    }

    public function waliSantri()
    {
        return $this->hasOne(WaliSantri::class);
    }

    public function berkas()
    {
        return $this->hasOne(Berkas::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function verifikasi()
    {
        return $this->hasOne(Verifikasi::class);
    }
}
