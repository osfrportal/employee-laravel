<?php

namespace Osfrportal\OsfrportalLaravel\Data;

use Spatie\LaravelData\Data;
use Osfrportal\OsfrportalLaravel\Enums\PersonsMovementsEnum;

class SFRPersonMovementData extends Data
{
    public function __construct(
        public int|PersonsMovementsEnum $movementType,
        public ?string $movementPid = null,
        public ?string $movementPersonFullFIO = null,
        public ?string $movementSnils = null,
        public ?string $movementDepartmentNew = null,
        public ?string $movementDepartmentNewID = null,
        public ?string $movementDepartmentOld = null,
        public ?string $movementDepartmentOldID = null,
        public ?string $movementAppointmentNew = null,
        public ?string $movementAppointmentNewID = null,
        public ?string $movementAppointmentOld = null,
        public ?string $movementAppointmentOldID = null,
    ) {
    }

    public static function defValues(): SFRPersonMovementData
    {
        return new self(
            PersonsMovementsEnum::NONE(),
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
        );
    }
}
