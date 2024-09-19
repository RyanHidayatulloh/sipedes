<?php

namespace app\models\Enums;

enum JenisSurat: string
{
        //  Surat Pengantar, Surat Keterangan, Surat Keterangan Usaha, Surat Pengantar Catatan Kepolisian, Surat Keterangan Tidak Mampu, Surat Keterangan Domisili Tempat Tinggal
    case SP = 'Surat Pengantar';
    case SK = 'Surat Keterangan';
    case SKU = 'Surat Keterangan Usaha';
    case SPCK = 'Surat Pengantar Catatan Kepolisian';
    case SKTM = 'Surat Keterangan Tidak Mampu';
    case SKDTT = 'Surat Keterangan Domisili Tempat Tinggal';

    public function code(): int
    {
        return match ($this) {
            self::SP => 1,
            self::SK => 2,
            self::SKU => 3,
            self::SPCK => 4,
            self::SKTM => 5,
            self::SKDTT => 6,
        };
    }

    public function fromCode(int $code): string
    {
        return match ($code) {
            1 => 'Surat Pengantar',
            2 => 'Surat Keterangan',
            3 => 'Surat Keterangan Usaha',
            4 => 'Surat Pengantar Catatan Kepolisian',
            5 => 'Surat Keterangan Tidak Mampu',
            6 => 'Surat Keterangan Domisili Tempat Tinggal',
        };
    }

    public static function forSelect(): array
    {
        return [
            1 => self::SP->value,
            2 => self::SK->value,
            3 => self::SKU->value,
            4 => self::SPCK->value,
            5 => self::SKTM->value,
            6 => self::SKDTT->value,
        ];
    }

    public static function toKodeSurat(int $code): string
    {
        return match ($code) {
            1 => "300",
            2 => "400",
            3 => "501.4",
            4 => "331",
            5 => '334',
            6 => '336',
        };
    }
}