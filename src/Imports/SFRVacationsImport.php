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
use Osfrportal\OsfrportalLaravel\Models\SfrPersonVacation;

class SFRVacationsImport implements ToCollection, WithCustomCsvSettings, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function rules(): array
    {

        return [
            'sotrudnikfiziceskoe_licoinn' => 'required|digits:12',
            'nacalo' => 'required|date',
            'okoncanie' => 'required|date',
        ];

    }

    public function collection(Collection $collection)
    {
        Log::withContext([
            'action' => LogActionsEnum::LOG_IMPORT_VACATION(),
        ]);
        $collection->each(function ($item) {
            $datestart = Carbon::createFromFormat('d.m.Y', $item['nacalo'])->format('Y-m-d');
            $dateend = Carbon::createFromFormat('d.m.Y', $item['okoncanie'])->format('Y-m-d');
            //dump($item['do']);
            $sfrperson = SFRPerson::where('pinn', $item['sotrudnikfiziceskoe_licoinn'])->first();
            if (!is_null($sfrperson)) {
                $result = SfrPersonVacation::firstOrCreate(
                    ['pid' => $sfrperson->pid, 'vacationstart' => $datestart, 'vacationend' => $dateend]
                );
                if ($result->wasRecentlyCreated) {
                    $log_context = [
                        'pid' => $sfrperson->pid,
                        'vacationstart' => $datestart,
                        'vacationend' => $dateend,
                    ];
                    Log::info('Добавлен отпуск работника', $log_context);
                }
            } else {
                $log_context = [
                    'inn' => $item['sotrudnikfiziceskoe_licoinn'],
                    'vacationstart' => $datestart,
                    'vacationend' => $dateend,
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