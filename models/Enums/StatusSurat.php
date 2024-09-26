<?php

namespace app\models\Enums;

enum StatusSurat: int {
    // Belum Dibuat, ACC RT, Sudah Diagendakan, Tertandatangani dan Tercetak
    case BelumBerjalan = 0;
    case RT = 1;
    case ActRT = 2;
    case AccRT = 3;
    case ActAgenda = 4;
    case Agenda = 5;
    case Tertandatangani = 6;
    case Tercetak = 7;

    // label
    public function label(): string
    {
        return match ($this) {
            self::BelumBerjalan => 'Belum Berjalan',
            self::RT => 'Menunggu Acc RT',
            self::ActRT => 'Aksi Pra RT',
            self::AccRT => 'ACC RT',
            self::ActAgenda => 'Aksi Pra Agenda',
            self::Agenda => 'Telah diagendakan',
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
