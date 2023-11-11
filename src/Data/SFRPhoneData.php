<?php

namespace Osfrportal\OsfrportalLaravel\Data;

use Spatie\LaravelData\Data;

class SFRPhoneData extends Data
{
    public function __construct(
        //make each property of the data object nullable like this:
        //public ?string $room,
        public ?string $contactdata_unit_name = null,
        public ?string $contactdata_unit_name_always = null,
        public ?string $contactdata_unit_id = null,
        public ?string $contactdata_unit_parentid = null,
        public ?string $contactdata_unit_parent_name = null,
        public ?SFRPersonData $contactdata_person = null,
        public ?SFRPhoneContactData $contactdata_phone_data = null,
    ) {}

    public static function defValues(): SFRPhoneData {
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
