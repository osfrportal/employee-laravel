<?php

namespace Osfrportal\OsfrportalLaravel\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * Enum класс определяющий типы сертификатов
 * @method static self UKEP()
 * @method static self UNEP()
 * @method static self DOMAIN()
 */
final class CertsTypesEnum extends Enum
{
    protected static function labels(): array
    {
        return [
            'UKEP' => 'УКЭП',
            'UNEP' => 'УНЭП',
            'DOMAIN' => 'Сертификат ActiveDirectory',
        ];
    }
    protected static function values(): array
    {
        return [
            'UKEP' => 1,
            'UNEP' => 2,
            'DOMAIN' => 3,
        ];
    }
}
