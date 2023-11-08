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
use Osfrportal\OsfrportalLaravel\Models\SfrUnits;
use Osfrportal\OsfrportalLaravel\Models\SfrAppointment;

class SFRDepartmentsImport implements ToCollection, WithCustomCsvSettings, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function rules(): array
    {

        return [
            'tabelnyi_nomer' => 'required',
            'sotrudnikfiziceskoe_lico_snils' => 'required',
            'podrazdelenie_nomer' => 'required',
            'dolznost' => 'required',
        ];

    }

    public function collection(Collection $collection)
    {
        Log::withContext([
            'action' => LogActionsEnum::LOG_IMPORT_DEPARTMENTS(),
        ]);
        $collection->each(function ($item) {
            $tab_number = trim($item['tabelnyi_nomer']);
            $podrazdelenie = trim(preg_replace('/\,\s[0-9]{2,}$/', '\1', $item['podrazdelenie_nomer'], -1));
            $podrazdelenie_nomer = trim(substr(strrchr($item['podrazdelenie_nomer'], ","), 1));
            $sotrudnikfiziceskoe_lico_snils = explode(",", $item['sotrudnikfiziceskoe_lico_snils']);
            $fio = explode(" ", preg_replace('/\s+/', ' ', $sotrudnikfiziceskoe_lico_snils[0]));
            $snils = trim(preg_replace('/[-\s]/', '', $sotrudnikfiziceskoe_lico_snils[1]));
            $dolznost = trim($item['dolznost']);
            $sfrperson = SFRPerson::with('SfrPersonAppointment', 'SfrPersonUnit', 'SfrPersonTabNum')->where('psnils', $snils)->first();

            if (!is_null($sfrperson)) {
                //Если нашли физ.лицо
                //ищем подразделение по совпадению номера и наименования. Если нет, создаем.
                $department = SfrUnits::firstOrCreate(
                    ['unitname' => $podrazdelenie],
                    ['unitcode' => $podrazdelenie_nomer]
                );
                if ($department->wasRecentlyCreated) {
                    $log_context = [
                        'unitname' => $podrazdelenie,
                        'unitcode' => $podrazdelenie_nomer,
                    ];
                    Log::info('Добавлено новое подразделение в справочник подразделений', $log_context);
                }
                //ищем должность по совпадению наименования. Если нет, создаем.
                $appointment = SfrAppointment::firstOrCreate(
                    ['aname' => $dolznost],
                );
                if ($appointment->wasRecentlyCreated) {
                    $log_context = [
                        'aname' => $dolznost,
                    ];
                    Log::info('Добавлена новая должность в справочник должностей', $log_context);
                }
                $sfrperson->SfrPersonUnit()->sync($department);
                $sfrperson->SfrPersonAppointment()->sync($appointment);
                $tn = $sfrperson->SfrPersonTabNum()->firstOrCreate(
                    ['etabnumber' => $tab_number],
                    ['updated_at' => Carbon::now()]
                );
                if ($tn->wasRecentlyCreated) {
                    $log_context = [
                        'etabnumber' => $tab_number,
                    ];
                    Log::info('Добавлен табельный номер работника', $log_context);
                }
                $sfrperson->save();
            } else {
                $log_context = [
                    'snils' => $snils,
                    'full_fio' => sprintf('%s %s %s', $fio[0], $fio[1], $fio[2]),
                    'podrazdelenie' => $podrazdelenie,
                    'podrazdelenie_nomer' => $podrazdelenie_nomer,
                    'dolznost' => $dolznost,

                ];
                Log::warning("Не найдено физ. лицо с СНИЛС", $log_context);
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