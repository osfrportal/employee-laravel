<?php

namespace Osfrportal\OsfrportalLaravel\LogsProcessorsCustom;

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
        $user = Auth::user();
        if (!empty($user)) {
            $record['extra']['user'] = $user->username;
            $record['extra']['sfrpersonpid'] = $user->sfrperson->getPid();
        }

        return $record;
    }
}