<?php

namespace Osfrportal\OsfrportalLaravel\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\DataCollectionOf;

class SFRUnitData extends Data
{
    public function __construct(
        //make each property of the data object nullable like this:
        //public ?string $room,
        public ?string $unitid = null,
        public ?string $unitname = null,
        public ?string $unitnameshort = null,
        public ?string $unitcode = null,
        public ?string $unitparentid = null,
        public ?string $unitsortorder = null,
        #[DataCollectionOf(SFRUnitData::class)]
        public ?DataCollection $childunits = null,
        public ?int $persons_count = 0,
        public ?int $children_count = 0,
    ) {}

    public static function defValues(): SFRUnitData {
        return new self(
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            0,
            0
        );
    }
}
