<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;

use Osfrportal\OsfrportalLaravel\Models\SfrUnits;

class SFRRcaUnitsImport
{
    public function import($filename, $storage)
    {
        Log::withContext([
            'action' => LogActionsEnum::LOG_IMPORT_RCA(),
        ]);
        if (Storage::disk($storage)->exists($filename)) {
            $unitsCount = 0;
            $xmlString = Storage::disk($storage)->get($filename);
            $xmlData = simplexml_load_string($xmlString);
            $units = $xmlData->xpath('//Org/ORG');
            foreach ($units as $unit) {
                $uid = trim($unit->id[0]->__toString());
                if ((!Str::is($uid, '058')) && (!Str::is($uid, '058-000'))) {
                    $unitID = Str::afterLast($uid, '-');
                    $unitName = trim($unit->Name[0]->__toString());
                    $unitParentID = Str::afterLast(trim($unit->ParentCode[0]->__toString()), '-');
                    $log_context = [
                        'unitname' => $unitName,
                        'unitcode' => $unitID,
                    ];
                    $modelUnit = SfrUnits::withTrashed()->updateOrCreate(
                        ['unitname' => $unitName],
                        [
                            'unitcode' => $unitID,
                            'deleted_at' => null,
                        ]
                    );
                    if ($modelUnit->wasRecentlyCreated) {
                        Log::info('Добавлено новое подразделение в справочник подразделений', $log_context);
                    }
                    if ($modelUnit->wasChanged('deleted_at')) {
                        Log::info('Подразделение восстановлено из удаленных', $log_context);
                    }
                    $unitsCount++;
                }
            }
            $log_context = [
                'unitsCount' => $unitsCount,
            ];
            Log::info('Обработка файла РСУД импорта подразделений завершена.', $log_context);
            return true;
        } else {
            Log::error('Не найден файл РСУД импорта подразделений.');
            return false;
        }
        Log::error('При обработке файла РСУД импорта подразделений произошла ошибка.');
        return false;
    }
}
