<?php

return [
    'enabled' => (bool) env('OSFRPORTAL_ENABLED', true),
    'name' => env('OSFRPORTAL_NAME', 'ОСФР по ......'),
    'shedule' => [
        'ImapDailyTime' => env('OSFRPORTAL_SH_DAILY_IMAP', '07:40'),
        'PersonsDailyTime' => env('OSFRPORTAL_SH_DAILY_PERSONS', '07:43'),
        'MovementsDailyTime' => env('OSFRPORTAL_SH_DAILY_MOVEMENTS', '07:45'),
        'DepatrmentsDailyTime' => env('OSFRPORTAL_SH_DAILY_DEPARTMENTS', '07:48'),
        'VacationDailyTime' => env('OSFRPORTAL_SH_DAILY_VACATION', '07:50'),
        'DekretDailyTime' => env('OSFRPORTAL_SH_DAILY_DEKRET', '07:52'),
    ],
];
