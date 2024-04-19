<?php

namespace Osfrportal\OsfrportalLaravel\Data\Infosystem;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Carbon\Carbon;

/**
 * @param string|Optional $controllerNameSync Имя контроллера для вызова методов синхронизации
 */
class SFRInfosystemData extends Data
{
    public string|Optional $controllerNameSync;

    /**
     * Конструктор DTO Информационная система
     * @param bool $syncWithIS Синхронизировать роли с подключением к ИС (API, SOAP интерфейс и т.д)
     */
    public function __construct(
        public ?bool $syncWithIS = false,
    ) {
        $this->controllerNameSync = '';
    }

    /*
    Вызов контроллера по имени:
    $model_name = 'User';
    $model = app("App\Model\{$model_name}");
    $model->where('id', $id)->first();
    */
}
