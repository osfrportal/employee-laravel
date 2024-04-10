<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;

use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Models\SfrUnits;
use Osfrportal\OsfrportalLaravel\Models\SfrAppointment;

use Illuminate\Support\Facades\Notification;
use Osfrportal\OsfrportalLaravel\Notifications\SFRRcaSync;
use Osfrportal\OsfrportalLaravel\Models\SfrUser;


use Osfrportal\OsfrportalLaravel\Data\SFRRcaImportStatusData;

class SFRRcaEmployeeImport
{
    protected $usersToNotify;
    public function __construct()
    {
        $redisKeyRCA = 'mainterance:rcaimport';
        $this->usersToNotify = SfrUser::permission('system-notifications')->get();

    }
    public function import($filename, $storage)
    {
        Log::withContext([
            'action' => LogActionsEnum::LOG_IMPORT_RCA(),
        ]);

        $worked = 0;
        $fired = 0;
        if (Storage::disk($storage)->exists($filename)) {
            $xmlString = Storage::disk($storage)->get($filename);
            $xmlData = simplexml_load_string($xmlString);
            $persons = $xmlData->xpath('//Persons/Person');
            foreach ($persons as $person) {
                $snils = preg_replace('/[-\s]/', '', $person->id[0]->__toString());
                $birthDate = Carbon::parse($person->dateofbirth[0]->__toString())->format('Y-m-d');
                $tabNumber = Str::remove('0000-', trim($person->Tab_id[0]->__toString()));
                $unitCode = Str::afterLast(trim($person->section[0]->__toString()), '-');
                $appointmentCode = trim($person->position[0]->__toString());

                $psurname = trim($person->lastname[0]->__toString());
                $pname = trim($person->firstname[0]->__toString());
                $pmiddlename = trim($person->middlename[0]->__toString());
                $pworkstart = trim($person->startdate[0]->__toString());

                $firedate = trim($person->firedate[0]->__toString());
                $workState = trim($person->state[0]->__toString());

                $fullFIO = sprintf('%s %s %s', $psurname, $pname, $pmiddlename);
                $unit = SfrUnits::where('unitcode', $unitCode)->firstOr(function () {
                    return null;
                });

                $appointment = SfrAppointment::where('acode', $appointmentCode)->firstOr(function () {
                    return null;
                });

                //Ищем по совпадению СНИЛС. Если СНИЛС не найден в базе - создаем.
                $sfrperson = SfrPerson::updateOrCreate(
                    ['psnils' => $snils],
                    [
                        'psurname' => $psurname,
                        'pname' => $pname,
                        'pmiddlename' => $pmiddlename,
                        'pbirthdate' => $birthDate,
                        'pworkstart' => $pworkstart,
                        'pcreatedon' => Carbon::now('Europe/Moscow')->toDateTimeString(),
                    ]
                );
                //если только создан:
                if ($sfrperson->wasRecentlyCreated) {

                    $log_context = [
                        'sfrperson' => $sfrperson,
                        'fio' => $fullFIO,
                    ];
                    Log::info('Добавлен работник', $log_context);
                }


                if (Str::is($workState, 'Работает')) {
                    $tn = $sfrperson->SfrPersonTabNum()->updateOrCreate(
                        ['etabnumber' => $tabNumber],
                        ['updated_at' => Carbon::now()]
                    );
                    if ($tn->wasRecentlyCreated) {
                        $log_context = [
                            'etabnumber' => $tabNumber,
                            'fio' => $fullFIO,
                        ];
                        Log::info('Добавлен табельный номер работника', $log_context);
                    }
                    if (!is_null($unit)) {
                        $sfrperson->SfrPersonUnit()->sync($unit);
                    }
                    if (!is_null($appointment)) {
                        $sfrperson->SfrPersonAppointment()->sync($appointment);
                    }
                    $sfrperson->save();
                    $worked++;
                }
                if (Str::is($workState, 'Уволен')) {
                    $sfrperson->SfrPersonUnit()->detach();
                    $sfrperson->SfrPersonAppointment()->detach();
                    $sfrperson->SfrPersonContacts()->delete();
                    $sfrperson->SfrPersonTabNum()->delete();
                    $sfrperson->pworkstart = null;
                    $sfrperson->save();
                    /*
                    $log_context = [
                        'pid' => $sfrperson->pid,
                        'fio' => $fullFIO,
                        'snils' => $snils,
                    ];
                    Log::info('Удалены записи из таблицы должностей, контакты, табельный номер для работника', $log_context);
                    */
                    $fired++;
                }

            }

            $log_context = [
                'fired' => $fired,
                'worked' => $worked,
            ];
            Log::info('Обработка файла РСУД импорта работников завершена.', $log_context);
            Notification::send($this->usersToNotify, new SFRRcaSync(sprintf('Обработка файла РСУД импорта работников завершена. fired: %s, worked: %s', $fired, $worked)));
            return true;
        } else {
            Log::error('Не найден файл РСУД импорта работников.');
            return false;
        }
        Log::error('При обработке файла РСУД импорта работников произошла ошибка.');
        return false;
    }
}
