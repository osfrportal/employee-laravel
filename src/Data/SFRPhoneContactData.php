<?php

namespace Osfrportal\OsfrportalLaravel\Data;

use Spatie\LaravelData\Data;

class SFRPhoneContactData extends Data
{
    public function __construct(
        //make each property of the data object nullable like this:
        //public ?string $room,
        public ?string $room = null,
        public ?string $address = null,
        public ?string $email_ext = null,
        public ?string $phone_external = null,
        public ?string $phone_internal = null,
        public ?string $phone_mobile = null,
        public ?string $areacode = null,
    ) {
    }

    public static function defValues(): SFRPhoneContactData
    {
        return new self(
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );
    }
}