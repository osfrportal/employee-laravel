<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;


use Osfrportal\OsfrportalLaravel\Models\SfrAppointment;

class SFRRcaAppointmentsImport
{
    public function import($filename, $storage)
    {
        Log::withContext([
            'action' => LogActionsEnum::LOG_IMPORT_RCA(),
        ]);
        if (Storage::disk($storage)->exists($filename)) {
            $appointmentsCount = 0;
            $xmlString = Storage::disk($storage)->get($filename);
            $xmlData = simplexml_load_string($xmlString);
            $appointments = $xmlData->xpath('//Post/Post');
            foreach ($appointments as $appointment) {
                $appointmentID = trim($appointment->id[0]->__toString());
                $appointmentName = trim($appointment->Name[0]->__toString());
                $log_context = [
                    'aname' => $appointmentName,
                    'acode' => $appointmentID,
                ];
                $modelAppointment = SfrAppointment::withTrashed()->updateOrCreate(
                    ['aname' => $appointmentName],
                    [
                        'acode' => $appointmentID,
                        'deleted_at' => null,
                    ]
                );
                if ($modelAppointment->wasRecentlyCreated) {
                    Log::info('Добавлена новая должность в справочник', $log_context);
                }
                if ($modelAppointment->wasChanged('deleted_at')) {
                    Log::info('Должность восстановлена из удаленных', $log_context);
                }
                $appointmentsCount++;

            }
            $log_context = [
                'appointmentsCount' => $appointmentsCount,
            ];
            Log::info('Обработка файла РСУД импорта должностей завершена.', $log_context);
            return true;
        } else {
            Log::error('Не найден файл РСУД импорта должностей.');
            return false;
        }
        Log::error('При обработке файла РСУД импорта должностей произошла ошибка.');
        return false;
    }
}
