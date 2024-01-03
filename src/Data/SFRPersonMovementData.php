<?php

namespace Osfrportal\OsfrportalLaravel\Data;

use Spatie\LaravelData\Data;
use Osfrportal\OsfrportalLaravel\Enums\PersonsMovementsEnum;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;

class SFRPersonMovementData extends Data
{
    public function __construct(
    #[WithCast(EnumCast::class)]
        public PersonsMovementsEnum $movementType,
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
    #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d')]
        public ?Carbon $movementEventDate = null
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
