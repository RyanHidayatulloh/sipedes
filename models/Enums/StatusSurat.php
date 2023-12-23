<?php

namespace app\models\Enums;

enum StatusSurat: int
{
    // Belum Dibuat, ACC RT, Sudah Diagendakan, Tertandatangani dan Tercetak
    case BelumDibuat = 0;
    case AccRT = 1;
    case SudahDiagendakan = 2;
    case Tertandatangani = 3;
    case Tercetak = 4;

    // label
    public function label(): string
    {
        return match ($this) {
            self::BelumDibuat => 'Belum Dibuat',
            self::AccRT => 'ACC RT',
            self::SudahDiagendakan => 'Sudah Diagendakan',
            self::Tertandatangani => 'Tertandatangani',
            self::Tercetak => 'Tercetak',
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