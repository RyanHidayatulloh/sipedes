<?php

namespace app\models\Enums;

enum Agama: string
{
        //  Islam, Kristen (Protestan), Hindu, Budha, Katolik, dan Konghucu

    case Islam = 'Islam';
    case Kristen = 'Kristen';
    case Hindu = 'Hindu';
    case Budha = 'Budha';
    case Katolik = 'Katolik';
    case Konghucu = 'Konghucu';

    public static function forSelect(): array
    {
        return collect(self::cases())
            ->map(function ($enum) {
                return $enum->value;
            })->toArray();
    }
}