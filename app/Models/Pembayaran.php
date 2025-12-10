<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use UuidTrait;

    protected $table = 'pembayaran';

    protected $fillable = [
        'pendaftar_id', 'nominal', 'bukti_transfer',
        'status', 'tanggal_bayar'
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class);
    }
}
