<?php

namespace Osfrportal\OsfrportalLaravel\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * Enum класс определяющий Тип носителя
 * @method static self USBFLASH()
 * @method static self USBHDD()
 * @method static self CDR()
 * @method static self CDRW()
 * @method static self DVDR()
 * @method static self DVDRW()
 * @method static self NONE()
 */

final class StorageTypesEnum extends Enum
{
    protected static function labels(): array
    {
        return [
            'USBFLASH' => 'USB Flash накопитель',
            'USBHDD' => 'USB Жесткий диск',
            'CDR' => 'Оптический носитель CD-R',
            'CDRW' => 'Оптический носитель CD-RW',
            'DVDR' => 'Оптический носитель DVD-R',
            'DVDRW' => 'Оптический носитель DVD-RW',
            'NONE' => 'Не определено',
        ];
    }
    protected static function values(): array
    {
        return [
            'USBFLASH' => 1,
            'USBHDD' => 2,
            'CDR' => 3,
            'CDRW' => 4,
            'DVDR' => 5,
            'DVDRW' => 6,
            'NONE' => 0,
        ];
    }
}
