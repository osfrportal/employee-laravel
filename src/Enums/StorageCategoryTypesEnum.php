<?php

namespace Osfrportal\OsfrportalLaravel\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * Enum класс определяющий категорию носителя
 * @method static self OFFICIAL()
 * @method static self CONFIDENTIAL()
 * @method static self NONE()
 */

final class StorageCategoryTypesEnum extends Enum
{
    protected static function labels(): array
    {
        return [
            'CONFIDENTIAL' => 'Конфиденциально',
            'OFFICIAL' => 'ДСП',
            'NONE' => 'Не определено',
        ];
    }
    protected static function values(): array
    {
        return [
            'CONFIDENTIAL' => 1,
            'OFFICIAL' => 2,
            'NONE' => 0,
        ];
    }
}
