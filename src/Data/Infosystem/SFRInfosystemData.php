<?php

namespace Osfrportal\OsfrportalLaravel\Data\Infosystem;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Carbon\Carbon;

class SFRInfosystemData extends Data
{
    /**
     * Конструктор DTO Информационная система
     * @param bool $syncWithIS Синхронизировать роли с подключением к ИС (API, SOAP интерфейс и т.д)
     * @param string|Optional $controllerNameSync Имя контроллера для вызова методов синхронизации
     */
    public function __construct(
        public ?bool $syncWithIS = false,
        public string|Optional $controllerNameSync,
    ) {
    }

    /*
    Вызов контроллера по имени:
    $model_name = 'User';
    $model = app("App\Model\{$model_name}");
    $model->where('id', $id)->first();
    */
}
