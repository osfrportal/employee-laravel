<?php

namespace Osfrportal\OsfrportalLaravel\Data\Orion;

/**
 * В конфиге data.php установить значение переменной
 * 'date_format' => [DATE_ATOM, 'Y-m-d\TH:i:s.000O'],
 */



use Spatie\LaravelData\Data;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Carbon\Carbon;

class TAccessLevelItemData extends Data
{
    public function __construct(
        public ?int $Id = 0,
        public ?string $ItemType = "",
        public ?int $ItemId = 0,
        public ?int $Rights = 0,
        public ?int $TimeWindowId = 0,
        public ?int $Antipassback = 0,
        public ?int $LockTime = 0,
        public ?bool $IsZonalAntipassback = false,
        public ?int $DoubleConfirmationId = 0,
        public ?int $TripleConfirmationId = 0,
        public ?bool $IsConfirming = false,
        public ?bool $IsConfirmationButton = false,
    ) {
    }
}
