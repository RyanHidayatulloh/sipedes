<?php

namespace app\models\Enums;

enum Pekerjaan: string
{

    case None = 'Belum/Tidak Bekerja';
    case Pejabat = 'Aparatur/Pejabat Negara';
    case Pengajar = 'Tenaga Pengajar';
    case Wiraswasta = 'Wiraswasta';
    case Petani = 'Pertanian/Peternakan';
    case Nelayan = 'Nelayan';
    case Agama = 'Agama dan Kepercayaan';
    case Pelajar = 'Pelajar/Mahasiswa';
    case Kesehatan = 'Tenaga Kesehatan';
    case Pensiunan = 'Pensiunan';
    case Lainnya = 'Lainnya';

    public static function forSelect(): array
    {
        return collect(self::cases())
            ->map(function ($enum) {
                return $enum->value;
            })->toArray();
    }
}
