<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class SekolahPilihan extends Model
{
    use UuidTrait;

    protected $table = 'sekolah_pilihan';

    protected $fillable = [
        'nama_sekolah', 'jenjang'
    ];

    public function pendaftar()
    {
        return $this->hasMany(Pendaftar::class);
    }
}
