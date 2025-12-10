<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class KategoriPengumuman extends Model
{
    use UuidTrait;

    protected $table = 'kategori_pengumuman';

    protected $fillable = ['nama_kategori'];

    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class, 'kategori_id');
    }
}
