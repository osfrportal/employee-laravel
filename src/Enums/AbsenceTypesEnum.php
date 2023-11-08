<?php

namespace Osfrportal\OsfrportalLaravel\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * Enum класс определяющий отсутствия
 * @method static self NONE()
 * @method static self DEKRET()
 * @method static self VACATION()
 * @method static self ABSENCE()
 */
final class AbsenceTypesEnum extends Enum
{
    protected static function labels(): array
    {
        return [
            'NONE' => '-',
            'DEKRET' => 'Отпуск по уходу за ребенком',
            'VACATION' => 'Отпуск',
            'ABSENCE' => 'Иное отсутствие (командировка, отпуск без сохранения зп и т.д)',
        ];
    }
    protected static function values(): array
    {
        return [
            'NONE' => 0,
            'DEKRET' => 1,
            'VACATION' => 2,
            'ABSENCE' => 3,
        ];
    }
}
