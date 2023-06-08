<?php
    return [
            'decree' => [
                'driver' => 'local',
                'root' => storage_path('app/decree'),
                'url' => '/decree',
                'visibility' => 'public',
                'throw' => false,
            ],
            'imports' => [
                'driver' => 'local',
                'root' => storage_path('app/imports'),
                'visibility' => 'public',
                'throw' => false,
            ],
            'ftp1c' => [
                'driver' => 'ftp',
                'host' => env('FTP_1C_HOST'),
                'username' => env('FTP_1C_USER'),
                'password' => env('FTP_1C_PASSWORD'),
                'passive' => env('FTP_1C_PASSIVE', true),
                'ssl' => env('FTP_1C_SSL', false),
            ],
    ];
