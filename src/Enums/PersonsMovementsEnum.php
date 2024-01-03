<?php

namespace Osfrportal\OsfrportalLaravel\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * Enum класс определяющий кадровые движения
 * @method static self PersonMove()
 * @method static self PersonFire()
 * @method static self PersonStart()
 * @method static self PersonRecovery()
 * @method static self NONE()
 */

final class PersonsMovementsEnum extends Enum
{
    protected static function labels(): array
    {
        return [
            'PersonMove' => 'Перемещение',
            'PersonFire' => 'Увольнение',
            'PersonStart' => 'Прием',
            'PersonRecovery' => 'Восстановление в должности',
            'NONE' => 'Не определено',
        ];
    }
    protected static function values(): array
    {
        return [
            'PersonMove' => 1,
            'PersonFire' => 2,
            'PersonStart' => 3,
            'PersonRecovery' => 4,
            'NONE' => 0,
        ];
    }
}
