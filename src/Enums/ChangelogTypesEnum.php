<?php

namespace Osfrportal\OsfrportalLaravel\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * Enum класс определяющий тип записи changelog
 * @method static self NONE()
 * @method static self ADD()
 * @method static self FIX()
 * @method static self TEST()
 */
final class ChangelogTypesEnum extends Enum
{
    protected static function labels(): array
    {
        return [
            'NONE' => '-',
            'ADD' => 'Добавление',
            'FIX' => 'Исправление',
            'TEST' => 'Тестовый функционал',
        ];
    }
    protected static function values(): array
    {
        return [
            'NONE' => 0,
            'ADD' => 1,
            'FIX' => 2,
            'TEST' => 3,
        ];
    }
}
