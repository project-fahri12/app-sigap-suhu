<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use UuidTrait;

    protected $table = 'berkas';

    protected $fillable = [
        'pendaftar_id', 'file_path', 'keterangan'
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class);
    }
}
