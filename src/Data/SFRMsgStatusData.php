<?php

namespace Osfrportal\OsfrportalLaravel\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Carbon\Carbon;

class SFRMsgStatusData extends Data
{
    public Carbon|Optional $date;

    public function __construct(
        public boolean $error = false,
        public ?string $message = '',
    ) {
        $this->date = Carbon::now();
    }
}