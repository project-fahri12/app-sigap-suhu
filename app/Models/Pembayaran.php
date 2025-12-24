<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory, UuidTrait;

    protected $table = 'pembayaran';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pendaftar_id',
        'order_id',
        'nominal',
        'snap_token',
        'status',
        'payment_type',
        'bukti_transfer',
        'keterangan',
        'tanggal_bayar'
    ];


    protected $casts = [
        'tanggal_bayar' => 'date',
        'nominal' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class, 'pendaftar_id', 'id');
    }

    /**
     * Helper untuk mengecek apakah pembayaran sudah lunas (Settlement)
     * Memudahkan pengecekan di View atau Middleware.
     */
    public function isLunas()
    {
        return in_array($this->status, ['settlement', 'capture', 'success']);
    }
}