<?php

namespace app\models\Enums;

enum Hubungan: string
{
    case Suami = 'Suami';
    case Istri = 'Istri';
    case Anak = 'Anak';
    case Menantu = 'Menantu';
    case Cucu = 'Cucu';
    case Keponakan = 'Keponakan';
    case OrangTua = 'Orang Tua';
    case Mertua = 'Mertua';
    case Lainnya = 'Lainnya';

    public static function forSelect(): array
    {
        return collect(self::cases())
            ->map(function ($enum) {
                return $enum->value;
            })->toArray();
    }
}