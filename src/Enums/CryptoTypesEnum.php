<?php

namespace Osfrportal\OsfrportalLaravel\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * Enum класс определяющий типы сертификатов
 * @method static self NONE()
 * @method static self VIPNET()
 * @method static self CRYPTOPRO()
 */
final class CryptoTypesEnum extends Enum
{
    protected static function labels(): array
    {
        return [
            'NONE' => 'Не определено',
            'VIPNET' => 'VipNet',
            'CRYPTOPRO' => 'КриптоПРО CSP',
        ];
    }
    protected static function values(): array
    {
        return [
            'NONE' => 0,
            'CRYPTOPRO' => 1,
            'VIPNET' => 2,
        ];
    }
}
