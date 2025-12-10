<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use UuidTrait;

    protected $table = 'orang_tua';

    protected $fillable = [
        'pendaftar_id', 'nama_ayah', 'pekerjaan_ayah', 'no_hp_ayah', 'status_ayah',
        'nama_ibu', 'pekerjaan_ibu', 'no_hp_ibu', 'status_ibu', 'alamat_orang_tua'
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class);
    }
}
