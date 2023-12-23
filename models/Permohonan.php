<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permohonan extends Model
{
    use SoftDeletes;
    public $table = "permohonan";

    protected $fillable = [
        'id_pemohon',
        'id_anggota',
        'jenis',
        'nomor',
        'keterangan',
        'keperluan',
        'status',
        'tgl_surat',
        'tgl_ttd',
    ];

    public function pemohon(): HasOne
    {
        return $this->hasOne(Pengguna::class, 'id_pemohon', 'id');
    }

    public function anggota(): HasOne
    {
        return $this->hasOne(KeluargaAnggota::class, 'id_anggota', 'id');
    }
}