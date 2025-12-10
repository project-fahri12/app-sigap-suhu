<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use UuidTrait;

    protected $table = 'pengumuman';

    protected $fillable = [
        'kategori_id', 'judul', 'isi', 'file_lampiran',
        'dibuat_oleh', 'tanggal',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriPengumuman::class, 'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
