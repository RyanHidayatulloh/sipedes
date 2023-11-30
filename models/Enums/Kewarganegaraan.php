<?php

namespace app\models\Enums;

enum Kewarganegaraan: string
{
    case WNI = 'Warga Negara Indonesia';
    case WNA = 'Warga Negara Asing';

    public static function fromChar(string $char): self
    {
        return match (strtoupper($char)) {
            'WNI' => self::WNI,
            'WNA' => self::WNA,
            default => throw new \Exception('Invalid char'),
        };
    }

    public static function forSelect(): array
    {
        return collect(self::cases())
            ->map(function ($enum) {
                return $enum->name;
            })->toArray();
    }
}