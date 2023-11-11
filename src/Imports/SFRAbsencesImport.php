<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;
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
use Osfrportal\OsfrportalLaravel\Models\SfrPersonAbsence;

class SFRAbsencesImport implements ToCollection, WithCustomCsvSettings, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function rules(): array
    {

        return [
            'sotrudnikfiziceskoe_licoinn' => 'required|digits:12',
            'period_otsutstviias' => 'required|date',
            'do' => 'required|date',
        ];

    }

    public function collection(Collection $collection)
    {
        Log::withContext([
            'action' => LogActionsEnum::LOG_IMPORT_ABSENCE(),
        ]);
        $collection->each(function ($item) {
            $datestart = Carbon::createFromFormat('d.m.Y', $item['period_otsutstviias'])->format('Y-m-d');
            $dateend = Carbon::createFromFormat('d.m.Y', $item['do'])->format('Y-m-d');
            //dump($item['do']);
            $sfrperson = SFRPerson::where('pinn', $item['sotrudnikfiziceskoe_licoinn'])->first();
            if (!is_null($sfrperson)) {
                $result = SfrPersonAbsence::firstOrCreate(
                    ['pid' => $sfrperson->pid, 'absencestart' => $datestart, 'absenceend' => $dateend]
                );
                if ($result->wasRecentlyCreated) {
                    $log_context = [
                        'pid' => $sfrperson->pid,
                        'absencestart' => $datestart,
                        'absenceend' => $dateend,
                    ];
                    Log::info('Добавлено отсутствие работника', $log_context);
                }
            } else {
                $log_context = [
                    'inn' => $item['sotrudnikfiziceskoe_licoinn'],
                    'absence_start' => $datestart,
                    'absence_end' => $dateend,
                ];
                Log::warning("Не найдено физ. лицо с ИНН", $log_context);
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