<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keluarga extends Model
{
    use SoftDeletes;
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

    public function anggota(): HasMany
    {
        return $this->hasMany(KeluargaAnggota::class, 'id_keluarga', 'id')->orderBy('hubungan', 'asc');
    }

    public function kepala(): HasOne
    {
        return $this->hasOne(KeluargaAnggota::class, 'id', 'id_kepala_keluarga');
    }
}