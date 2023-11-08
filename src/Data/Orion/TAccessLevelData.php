<?php

namespace Osfrportal\OsfrportalLaravel\Data\Orion;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\DataCollectionOf;

use Carbon\Carbon;

use Osfrportal\OsfrportalLaravel\Data\Orion\TAccessLevelItemData;

class TAccessLevelData extends Data
{
    public function __construct(
        public ?int $Id = 0,
        public ?string $Name = "",
        public ?string $Description = "",
    #[DataCollectionOf(TAccessLevelItemData::class)] public DataCollection $Items)
    {
    }
}
