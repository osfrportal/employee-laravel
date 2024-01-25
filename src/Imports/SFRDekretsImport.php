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

class SFRDekretsImport implements ToCollection, WithCustomCsvSettings, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function rules(): array
    {

        return [
            'sotrudnikfiziceskoe_licoinn' => 'required|digits:12',
        ];

    }

    public function collection(Collection $collection)
    {
        Log::withContext([
            'action' => LogActionsEnum::LOG_IMPORT_DEKRET(),
        ]);
        $collection->each(function ($item) {
            $str_to_remove = ['предположительно до ', ' 0:00:00'];
            $datestart = Carbon::createFromFormat('d.m.Y', $item['period_otsutstviias'])->format('Y-m-d');
            $dateend = Carbon::createFromFormat('d.m.Y', Str::remove($str_to_remove, $item['do'], false))->format('Y-m-d');

            $sfrperson = SFRPerson::where('pinn', $item['sotrudnikfiziceskoe_licoinn'])->first();
            if (!is_null($sfrperson)) {
                //проверяем, есть ли в базе декрет с указанной датой старта
                $resultStart = $sfrperson->SfrPersonDekret()->where('dekretstart','=', $datestart)->get();
                if (!is_null($resultStart)) {
                    //если нашли такой декрет проверяем дату окончания
                    //if ($resultStart->dekretend !== $dateend) {
                        dump($resultStart);
                    //}
                }
                /*
                $result = $sfrperson->SfrPersonDekret()->firstOrCreate(
                    ['pid' => $sfrperson->pid, 'dekretstart' => $datestart, 'dekretend' => $dateend]
                );
                if ($result->wasRecentlyCreated) {
                    $sfrperson->SfrPersonContacts()->delete();
                    $sfrperson->save();
                    $log_context = [
                        'pid' => $sfrperson->pid,
                        'dekretstart' => $datestart,
                        'dekretend' => $dateend,
                    ];
                    Log::info('Добавлен декретный отпуск работника', $log_context);
                }
                */
            } else {
                $log_context = [
                    'inn' => $item['sotrudnikfiziceskoe_licoinn'],
                    'dekretstart' => $datestart,
                    'dekretend' => $dateend,
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
