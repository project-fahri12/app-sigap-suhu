<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Gelombang extends Model
{
    use UuidTrait;

    protected $table = 'gelombang';

    protected $fillable = [
        'tahun_ajaran_id', 'nama_gelombang', 'status',
        'tanggal_mulai', 'tanggal_selesai'
    ];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function pendaftar()
    {
        return $this->hasMany(Pendaftar::class);
    }
}
