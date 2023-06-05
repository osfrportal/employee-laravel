<?php

namespace Osfrportal\OsfrportalLaravel\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * Enum класс определяющий кадровые движения
 * @method static self PersonMove
 * @method static self PersonFire
 * @method static self PersonStart
 */
final class PersonsMovementsEnum extends Enum
{
    protected static function labels(): array
    {
        return [
            'PersonMove' => 'Перемещение',
            'PersonFire' => 'Увольнение',
            'PersonStart' => 'Прием',
        ];
    }
    protected static function values(): array
    {
        return [
            'PersonMove' => 1,
            'PersonFire' => 2,
            'PersonStart' => 3,
        ];
    }
}
