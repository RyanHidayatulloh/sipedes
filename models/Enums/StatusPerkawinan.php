<?php

namespace app\models\Enums;

enum StatusPerkawinan: string
{
    case BelumKawin = 'Belum Kawin';
    case Kawin = 'Kawin';
    case CeraiHidup = 'Cerai Hidup';
    case CeraiMati = 'Cerai Mati';

    public static function forSelect(): array
    {
        return collect(self::cases())
            ->map(function ($enum) {
                return $enum->value;
            })->toArray();
    }
}
