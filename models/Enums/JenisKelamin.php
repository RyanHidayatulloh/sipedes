<?php

namespace app\models\Enums;

enum JenisKelamin: string
{
    case Pria = 'Laki-laki';
    case Wanita = 'Perempuan';

    public static function fromBiner(int $biner): self
    {
        return match (intval($biner)) {
            0 => self::Pria,
            1 => self::Wanita,
            default => throw new \Exception('Invalid biner'),
        };
    }

    public static function fromChar(string $char): self
    {
        return match (strtoupper($char)) {
            'L' => self::Pria,
            'P' => self::Wanita,
            default => throw new \Exception('Invalid char'),
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
