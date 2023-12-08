<?php

namespace Osfrportal\OsfrportalLaravel\Data;

use Spatie\LaravelData\Data;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;

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
        public ?string $vipnetapname = null,
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
            null,
            null
        );
    }

    public static function fromModel(SfrPerson $person): self
    {
        $contactdata = json_decode($person->getPersonContactData());
        if (!is_null($contactdata)) {
            return new self(
                room: $contactdata->room,
                address: $contactdata->address,
                email_ext: $contactdata->email_ext,
                phone_external: $contactdata->phone_external,
                phone_internal: $contactdata->phone_internal,
                phone_mobile: $contactdata->phone_mobile,
                areacode: $contactdata->areacode,
            );
        } else {
            return new self;
        }

    }
}
