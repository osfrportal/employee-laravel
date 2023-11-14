<?php

namespace Osfrportal\OsfrportalLaravel\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self LOG_IMPORT_PD()
 * @method static self LOG_PERSON_ADD()
 * @method static self LOG_IMPORT_DEPARTMENTS()
 * @method static self LOG_IMPORT_DIALPLAN()
 * @method static self LOG_IMPORT_VACATION()
 * @method static self LOG_IMPORT_ABSENCE()
 * @method static self LOG_IMPORT_EMPLOYEE()
 * @method static self LOG_IMPORT_KADRY()
 * @method static self LOG_IMPORT_DEKRET()
 * @method static self LOG_IMPORT_JMS()
 * @method static self LOG_SYNC_SKUD()
 * @method static self LOG_SYNC_CERTS()
 * @method static self LOG_PHONE_UPDATE()
 * @method static self LOG_AD()
 * @method static self LOG_ADD_ADLOGIN()
 * @method static self LOG_VIEW_PERSON()
 * @method static self LOG_DOC_SIGN()
 * @method static self LOG_AUTH()
 * @method static self LOG_IMAP()
 * @method static self LOG_APP()
 *
 */
final class LogActionsEnum extends Enum
{
    /*
    protected static function labels(): array
    {
        return [
            'LOG_IMPORT_PD' => '',
            'LOG_PERSON_ADD' => '',
            'LOG_IMPORT_DEPARTMENTS' => '',
            'LOG_IMPORT_DIALPLAN' => '',
            'LOG_IMPORT_VACATION' => '',
            'LOG_IMPORT_EMPLOYEE' => '',
            'LOG_IMPORT_KADRY' => '',
            'LOG_IMPORT_DEKRET' => '',
            'LOG_IMPORT_JMS' => '',
            'LOG_PHONE_UPDATE' => '',
            'LOG_AD' => '',
            'LOG_ADD_ADLOGIN' => '',
            'LOG_VIEW_PERSON' => '',
            'LOG_AUTH' => '',
            'LOG_APP' => '',
        ];
    }
    */
    protected static function values(): array
    {
        return [
            'LOG_IMPORT_PD' => 1,
            'LOG_PERSON_ADD' => 2,
            'LOG_IMPORT_DEPARTMENTS' => 3,
            'LOG_IMPORT_DIALPLAN' => 4,
            'LOG_IMPORT_VACATION' => 10,
            'LOG_IMPORT_ABSENCE' => 15,
            'LOG_IMPORT_EMPLOYEE' => 20,
            'LOG_IMPORT_KADRY' => 30,
            'LOG_IMPORT_DEKRET' => 40,
            'LOG_IMPORT_JMS' => 50,
            'LOG_SYNC_SKUD' => 51,
            'LOG_SYNC_CERTS' => 52,
            'LOG_PHONE_UPDATE' => 60,
            'LOG_AD' => 70,
            'LOG_ADD_ADLOGIN' => 71,
            'LOG_VIEW_PERSON' => 80,
            'LOG_DOC_SIGN' => 90,
            'LOG_AUTH' => 888,
            'LOG_IMAP' => 998,
            'LOG_APP' => 999,
        ];
    }
}