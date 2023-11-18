<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class KeluargaAnggota extends Model
{
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
        'fotos',
        'ktp',
    ];
}
