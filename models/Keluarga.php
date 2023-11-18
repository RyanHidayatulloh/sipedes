<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    public $table = "keluarga";
    protected $fillable = [
        'id_user',
        'id_kepala_keluarga',
        'alamat',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kota',
        'provinsi',
        'kodepos',
        'kk',
    ];
}
