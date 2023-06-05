<?php

namespace Osfrportal\OsfrportalLaravel\Data;

use Spatie\LaravelData\Data;

class SFRPersonData extends Data
{
    public function __construct(
        public ?string $persondata_pid = null,
        public ?string $persondata_tabnum= null,
        public ?string $persondata_psurname= null,
        public ?string $persondata_pname= null,
        public ?string $persondata_pmiddlename= null,
        public ?string $persondata_appointment= null,
        public ?string $persondata_unit_name= null,
        public ?string $persondata_vacation= null,
        //public ?string $persondata_= null,
    ) {}

    public static function defValues(): SFRPersonData {
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
}
