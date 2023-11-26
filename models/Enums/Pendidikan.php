<?php

namespace app\models\Enums;

enum Pendidikan: string
{
    case None = 'Tidak / Belum Sekolah';
    case TK = 'TK';
    case SD = 'SD/Sederajat';
    case SMP = 'SMP/Sederajat';
    case SMA = 'SMA/Sederajat';
    case D1 = 'D1';
    case D2 = 'D2';
    case D3 = 'D3';
    case D4 = 'D4';
    case S1 = 'S1';
    case S2 = 'S2';
    case S3 = 'S3';

    public static function forSelect(): array
    {
        return collect(self::cases())
            ->map(function ($enum) {
                return $enum->value;
            })->toArray();
    }
}
