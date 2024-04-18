<?php

namespace Osfrportal\OsfrportalLaravel\Data\Infosystem;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

use Carbon\Carbon;

class SFRInfosystemRelData extends Data
{
    /**
     * Конструктор DTO данные информационной системы по работнику (столбец reldata таблицы relation_sfrinfosystems_persons)
     * @param string $isLogin имя пользователя работника в информационной системе
     * @param string|Optional $relDescription Описание роли/комментарий
     */
    public function __construct(
        public string $isLogin = '',
        public string|Optional $relDescription,
    ) {
    }
}
