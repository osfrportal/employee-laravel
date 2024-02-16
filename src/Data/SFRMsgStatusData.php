<?php

namespace Osfrportal\OsfrportalLaravel\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Carbon\Carbon;

class SFRMsgStatusData extends Data
{
    public Carbon|Optional $date;

    public function __construct(
        public integer $error = 0,
        public ?string $message = '',
    ) {
        $this->date = Carbon::now();
    }
}