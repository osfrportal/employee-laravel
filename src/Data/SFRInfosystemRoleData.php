<?php

namespace Osfrportal\OsfrportalLaravel\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

use Carbon\Carbon;

class SFRInfosystemRoleData extends Data
{
    /**
     * Конструктор DTO Роль информационной системы
     * @param string $roleName Имя роли
     * @param array $roleData Данные роли
     * @param string $roleDescription Описание роли/комментарий
     * @param string|Optional $roleID Идентификатор роли в формате uuid
     */
    public function __construct(
        public string $roleName = '',
        public ?array $roleData = [],
        public ?string $roleDescription = '',
        public string|Optional $roleID,
    ) {
    }
}
