<?php

namespace app\models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use yii\helpers\Url;

class Penduduk extends Model
{
    use SoftDeletes;
    public $table = "penduduk";

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
        "kodepos",
        "ktp",
        "kk",
    ];
    
    protected function ktp(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Url::to("@web/uploads/ktp/$value") : null,
        );
    }
    protected function kk(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Url::to("@web/uploads/kk/$value") : null,
        );
    }
}
