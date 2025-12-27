<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use UuidTrait;

    protected $table = 'orang_tua';

    protected $fillable = [
        'pendaftar_id',

        // Data Ayah
        'nama_ayah',
        'pekerjaan_ayah',
        'status_ayah',

        // Data Ibu
        'nama_ibu',
        'pekerjaan_ibu',
        'status_ibu',

        // Alamat
        'alamat_orang_tua',

        // Kontak
        'email',
        'no_wa_utama',
        'pemilik_no_utama',
        'no_wa_cadangan',
        'pemilik_no_cadangan',
    ];


    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class);
    }
}
