<?php

namespace app\models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeluargaAnggota extends Model
{
    use SoftDeletes;
    public $table = "keluarga_anggota";
    protected $fillable = [
        'id_keluarga',
        'nama',
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'pendidikan',
        'pekerjaan',
        'hubungan',
        'kawin',
        'kewarganegaraan',
        'agama',
        'alamat',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kota',
        'provinsi',
        'kodepos',
        'no_hp',
        'email',
        'foto',
        'ktp',
    ];

    protected function tglLahir(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value,
            set: fn (string $value) => Carbon::createFromFormat("d/m/Y", $value),
        );
    }
}
