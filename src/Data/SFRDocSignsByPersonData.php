<?php

namespace Osfrportal\OsfrportalLaravel\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\DataCollectionOf;

class SFRDocSignsByPersonData extends Data
{
    public function __construct(
        public ?SFRPersonData $personData = null,
        #[DataCollectionOf(SFRSignData::class)]
        public ?DataCollection $signData = null,
    ) {}

    public static function defValues(): SFRDocSignsByPersonData {
        return new self(
            null,
            null,
        );
    }
}
