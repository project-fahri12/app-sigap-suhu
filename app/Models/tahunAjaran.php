<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use UuidTrait;

    protected $table = 'tahun_ajaran';

    protected $fillable = [
        'tahun', 'status', 'tanggal_mulai', 'tanggal_selesai'
    ];

    public function gelombang()
    {
        return $this->hasMany(Gelombang::class);
    }

    public function pendaftar()
    {
        return $this->hasMany(Pendaftar::class);
    }
}
