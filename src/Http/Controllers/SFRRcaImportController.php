<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;

use Osfrportal\OsfrportalLaravel\Imports\SFRRcaAppointmentsImport;
use Osfrportal\OsfrportalLaravel\Imports\SFRRcaUnitsImport;
use Osfrportal\OsfrportalLaravel\Imports\SFRRcaEmployeeImport;

use Illuminate\Support\Facades\Notification;
use Osfrportal\OsfrportalLaravel\Notifications\SFRRcaSync;
use Osfrportal\OsfrportalLaravel\Models\SfrUser;

use Illuminate\Support\Arr;
use Osfrportal\OsfrportalLaravel\Actions\LogAddAction;
use Illuminate\Support\Facades\Redis;

use Osfrportal\OsfrportalLaravel\Data\SFRRcaImportStatusData;

class SFRRcaImportController extends Controller
{
    protected $usersToNotify;
    private $redisRCAMessage;
    private $tryAgain = true;
    private $redisKeyRCA = 'mainterance:rcaimport';

    public function __construct()
    {
        parent::__construct();

        $redisRCAMessageBlank = ['error' => false, 'message' => '', 'tryAgain' => true, 'importsStatus' => false];
        if (Redis::exists($this->redisKeyRCA)) {
            $dateToday = Carbon::now();

            $keyData = json_decode(Redis::get($this->redisKeyRCA));
            $dateFromRedis = Carbon::parse($keyData->date);

            if ($dateToday->isSameDay($dateFromRedis)) {
                if (!$keyData->tryAgain) {
                    exit(0);
                } else {
                    $this->redisRCAMessage = ['error' => $keyData->error, 'message' => $keyData->message, 'tryAgain' => $keyData->tryAgain, 'importsStatus' => $keyData->importsStatus];
                    $this->tryAgain = $keyData->tryAgain;
                }
            } else {
                $this->redisRCAMessage = $redisRCAMessageBlank;
                $this->tryAgain = true;
            }
        } else {
            $this->redisRCAMessage = $redisRCAMessageBlank;
            $this->tryAgain = true;
        }

        Redis::set($this->redisKeyRCA, SFRRcaImportStatusData::from($this->redisRCAMessage)->toJson());

        $this->usersToNotify = SfrUser::permission('system-notifications')->get();

    }
    public function runRcaFilesGet()
    {
        if ($this->tryAgain) {
            $statusImportPost = false;
            $statusImportOrg = false;
            $statusImportEmployee = false;

            $fileImportPost = null;
            $fileImportOrg = null;
            $fileImportEmployee = null;

            $storageRO = 'RCAimportRO';
            $folderRO = 'oim_arch';
            $filesRO = Storage::disk($storageRO)->files($folderRO);
            $dt = Carbon::now()->format('Ymd');
            $pregstring = sprintf('/^(oim_arch\/000_%s)(post|org|employee)_(.*)/i', $dt);
            $matchingFiles = preg_grep($pregstring, $filesRO);
            $countFiles = count($matchingFiles);
            if ($countFiles == 3) {
                foreach ($matchingFiles as $matchingFile) {
                    if (preg_match(sprintf('/^(oim_arch\/000_%s)post_(.*)/i', $dt), $matchingFile)) {
                        $fileImportPost = $matchingFile;
                    }
                    if (preg_match(sprintf('/^(oim_arch\/000_%s)org_(.*)/i', $dt), $matchingFile)) {
                        $fileImportOrg = $matchingFile;
                    }
                    if (preg_match(sprintf('/^(oim_arch\/000_%s)employee_(.*)/i', $dt), $matchingFile)) {
                        $fileImportEmployee = $matchingFile;
                    }
                }
                if (!is_null($fileImportPost)) {
                    $importAppointments = new SFRRcaAppointmentsImport();
                    $statusImportPost = $importAppointments->import($fileImportPost, $storageRO);
                } else {
                    Arr::set($this->redisRCAMessage, 'error', true);
                    Arr::set($this->redisRCAMessage, 'message', 'Произошла ошибка при перед началом обработки файла post');
                    Arr::set($this->redisRCAMessage, 'tryAgain', true);
                    Arr::set($this->redisRCAMessage, 'importsStatus', false);
                    Redis::set($this->redisKeyRCA, SFRRcaImportStatusData::from($this->redisRCAMessage)->toJson());
                }
                if (!is_null($fileImportOrg) && ($statusImportPost === true)) {
                    $importUnits = new SFRRcaUnitsImport();
                    $statusImportOrg = $importUnits->import($fileImportOrg, $storageRO);
                } else {
                    Arr::set($this->redisRCAMessage, 'error', true);
                    Arr::set($this->redisRCAMessage, 'message', 'Произошла ошибка при перед началом обработки файла org');
                    Arr::set($this->redisRCAMessage, 'tryAgain', true);
                    Arr::set($this->redisRCAMessage, 'importsStatus', false);
                    Redis::set($this->redisKeyRCA, SFRRcaImportStatusData::from($this->redisRCAMessage)->toJson());
                }
                if (!is_null($fileImportOrg) && ($statusImportPost === true) && ($statusImportOrg === true)) {
                    $importEmployee = new SFRRcaEmployeeImport();
                    $statusImportEmployee = $importEmployee->import($fileImportEmployee, $storageRO);
                } else {
                    Arr::set($this->redisRCAMessage, 'error', true);
                    Arr::set($this->redisRCAMessage, 'message', 'Произошла ошибка при перед началом обработки файла employee');
                    Arr::set($this->redisRCAMessage, 'tryAgain', true);
                    Arr::set($this->redisRCAMessage, 'importsStatus', false);
                    Redis::set($this->redisKeyRCA, SFRRcaImportStatusData::from($this->redisRCAMessage)->toJson());
                }
                Arr::set($this->redisRCAMessage, 'error', false);
                Arr::set($this->redisRCAMessage, 'message', 'Обработка файлов RS:УД успешно завершена');
                Arr::set($this->redisRCAMessage, 'tryAgain', false);
                Arr::set($this->redisRCAMessage, 'importsStatus', true);
                Redis::set($this->redisKeyRCA, SFRRcaImportStatusData::from($this->redisRCAMessage)->toJson());
            } else {
                Arr::set($this->redisRCAMessage, 'error', true);
                Arr::set($this->redisRCAMessage, 'message', 'Количество файлов импорта RS:УД не равно 3');
                Arr::set($this->redisRCAMessage, 'tryAgain', true);
                Arr::set($this->redisRCAMessage, 'importsStatus', false);
                Redis::set($this->redisKeyRCA, SFRRcaImportStatusData::from($this->redisRCAMessage)->toJson());
            }
        }
    }
}
