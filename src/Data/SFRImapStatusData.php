<?php

namespace Osfrportal\OsfrportalLaravel\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Carbon\Carbon;

class SFRImapStatusData extends Data
{
    public Carbon|Optional $date;

    public function __construct(
        public bool $error = false,
        public ?string $message = '',
        public bool $tryAgain = false,
    ) {
        $this->date = Carbon::now();
    }
}