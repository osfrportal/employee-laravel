<?php

namespace Osfrportal\OsfrportalLaravel\LogsProcessorCustom;

use Illuminate\Support\Facades\Auth;
use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;

class AuthenticatedUserProcessor implements ProcessorInterface
{
    /**
     * @return array The processed record
     */
    public function __invoke(LogRecord $record)
    {
        $record['extra']['user'] = Auth::user();

        return $record;
    }
}