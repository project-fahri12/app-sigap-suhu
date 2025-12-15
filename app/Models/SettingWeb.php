<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingWeb extends Model
{
    protected $table = 'setting_web';

    protected $fillable = [
        'setting_key',
        'setting_value',
    ];
}
