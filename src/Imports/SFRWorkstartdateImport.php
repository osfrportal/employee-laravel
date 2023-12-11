<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;

use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Models\SfrPersonDekret;

class SFRWorkstartdateImport implements ToCollection, WithCustomCsvSettings, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function rules(): array
    {

        return [
            'snils' => 'required|regex:(\d{3}-\d{3}-\d{3} \d{2})',
            'data_priema' => 'required|date',
        ];

    }

    public function collection(Collection $collection)
    {
        Log::withContext([
            'action' => LogActionsEnum::LOG_IMPORT_PERSONWORKSTART(),
        ]);
        $collection->each(function ($item) {
            $dateStartWork = Carbon::createFromFormat('d.m.Y', $item['data_priema'])->format('Y-m-d');
            $snils = preg_replace('/[-\s]/', '', $item['snils']);
            $sfrperson = SfrPerson::where('psnils', $snils)->first();

            if (!is_null($sfrperson)) {
                $log_context = [
                    'pid' => $sfrperson->pid,
                    'dateStartWork' => $dateStartWork,
                ];
                $sfrperson->pworkstart = $dateStartWork;
                $sfrperson->save();
                if ($sfrperson->wasChanged('pworkstart')) {
                    Log::info('Обновлена дата начала работы работника', $log_context);
                }
            } else {
                $log_context = [
                    'snils' => $item['snils'],
                    'dateStartWork' => $dateStartWork,
                ];
                Log::warning("Не найдено физ. лицо со СНИЛС", $log_context);
            }
        });
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => "\t",
            'input_encoding' => 'UTF-8'
        ];
    }
}
