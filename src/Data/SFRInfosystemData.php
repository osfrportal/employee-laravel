<?php

namespace Osfrportal\OsfrportalLaravel\Data;

use Spatie\LaravelData\Data;
use Carbon\Carbon;

class SFRInfosystemData extends Data
{
    /**
     * Конструктор DTO Информационная система
     * @param bool $syncWithIS Синхронизировать роли с подключением к ИС (API, SOAP интерфейс и т.д)
     * @param string $controllerNameSync Имя контроллера для вызова методов синхронизации
     */
    public function __construct(
        public ?bool $syncWithIS = false,
        public ?string $controllerNameSync = '',
    ) {
    }

    /*
    Вызов контроллера по имени:
    $model_name = 'User';
    $model = app("App\Model\{$model_name}");
    $model->where('id', $id)->first();
    */
}
