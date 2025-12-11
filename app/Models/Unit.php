<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use UuidTrait;

    protected $table = 'unit';

    protected $fillable = [
        'nama_unit'
    ];

    public function pendaftar()
    {
        return $this->hasMany(Pendaftar::class);
    }
}
