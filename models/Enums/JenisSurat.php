<?php

namespace app\models\Enums;

enum JenisSurat: int
{
    //  Surat Keterangan Usaha, Surat Pengantar, Surat Keterangan, Surat Pengantar Catatan Kepolisian
    case SKU = 1;
    case SP = 2;
    case SK = 3;
    case SKP = 4;
    
    public function label(): string
    {
        return match ($this) {
            self::SKU => 'Surat Keterangan Usaha',
            self::SP => 'Surat Pengantar',
            self::SK => 'Surat Keterangan',
            self::SKP => 'Surat Pengantar Catatan Kepolisian',
        };
    }

    public static function forSelect(): array
    {
        return collect(self::cases())
            ->map(function ($enum) {
                return $enum->value;
            })->toArray();
    }
}