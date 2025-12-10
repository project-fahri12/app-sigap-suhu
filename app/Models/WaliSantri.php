<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class WaliSantri extends Model
{
    use UuidTrait;

    protected $table = 'wali_santri';

    protected $fillable = [
        'pendaftar_id', 'nama_wali', 'pekerjaan_wali',
        'hubungan_wali', 'alamat_wali', 'no_hp_wali'
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class);
    }
}
