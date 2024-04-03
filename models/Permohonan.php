<?php

namespace app\models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use yii\helpers\Url;

class Permohonan extends Model
{
    use SoftDeletes;
    public $table = "permohonan";

    protected $fillable = [
        'id_pemohon',
        'jenis',
        'nomor',
        'keterangan',
        'keperluan',
        'status',
        'tgl_surat',
        'tgl_ttd',
        'file',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tgl_surat' => 'datetime:Y-m-d',
            'tgl_ttd' => 'datetime:Y-m-d',
        ];
    }

    protected function jenis(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => $value ? intval($value) : null,
        );
    }
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => $value ? intval($value) : null,
        );
    }

    protected function file(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? Url::to("@web/uploads/permohonan/$value") : null,
        );
    }

    public function pemohon(): HasOne
    {
        return $this->hasOne(Pengguna::class, 'id', 'id_pemohon');
    }
}
