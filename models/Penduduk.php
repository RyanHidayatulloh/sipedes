<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penduduk extends Model
{
    use SoftDeletes;
    public $table = "penduduk";

    // id_user
    // nama
    // nik
    // nokk
    // jenis_kelamin
    // tempat_lahir
    // tgl_lahir
    // pendidikan
    // pekerjaan
    // hubungan
    // status_perkawinan
    // kewarganegaraan
    // agama
    // alamat
    // rt
    // rw
    // desa
    // kecamatan
    // kota
    // // provinsi
    // kodepos
    protected $fillable = [
        "id_user",
        "nama",
        "nik",
        "nokk",
        "jenis_kelamin",
        "tempat_lahir",
        "tgl_lahir",
        "pendidikan",
        "pekerjaan",
        "hubungan",
        "status_perkawinan",
        "kewarganegaraan",
        "agama",
        "alamat",
        "rt",
        "rw",
        "desa",
        "kecamatan",
        "kota",
        "provinsi",
        "kodepos"
    ];
}
