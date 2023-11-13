<?php

namespace Osfrportal\OsfrportalLaravel\LogsProcessorsCustom;

use Illuminate\Support\Facades\Auth;
use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;
/**
 * Injects sfrperson data in all log records
 */
class AuthenticatedUserProcessor implements ProcessorInterface
{
    public function __invoke(LogRecord $record): LogRecord
    {
        $user = Auth::user();
        if (!empty($user)) {
            $record['extra']['sfrperson_username'] = $user->username;
            $record['extra']['sfrperson_pid'] = $user->sfrperson->getPid();
            $record['extra']['sfrperson_fio'] = $user->sfrperson->getFullName();
        }

        return $record;
    }
}