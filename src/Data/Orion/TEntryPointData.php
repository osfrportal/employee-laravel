<?php

namespace Osfrportal\OsfrportalLaravel\Data\Orion;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\DataCollectionOf;

class TEntryPointData extends Data
{
    public function __construct(
        public ?int $Id = 0,
        public ?string $Name = "",
        public ?int $EnterAccessZoneId = 0,
        public ?int $ExitAccessZoneId = 0,
        public ?int $EntryPointType = 1,
        public ?int $Index = 0,
        public ?array $Readers = [],
    )
    {
    }
}
