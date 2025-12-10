<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    use UuidTrait;

    protected $table = 'verifikasi';

    protected $fillable = [
        'pendaftar_id', 'verifikasi_berkas', 'verifikasi_pembayaran',
        'catatan', 'diverifikasi_oleh', 'tanggal'
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }
}
