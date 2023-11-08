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

class SFRPersonsImport implements ToCollection, WithCustomCsvSettings, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function rules(): array
    {

        return [
            'inn' => 'required|digits:12',
            'snils' => 'required|regex:(\d{3}-\d{3}-\d{3} \d{2})',
            'sotrudnikfiziceskoe_lico' => 'required',
            'data_rozdeniia' => 'required|date',
        ];


    }

    public function collection(Collection $collection)
    {
        Log::withContext([
            'action' => LogActionsEnum::LOG_IMPORT_PD(),
        ]);
        $collection->each(function ($item) {
            $fio = explode(" ", preg_replace('/\s+/', ' ', $item['sotrudnikfiziceskoe_lico']));
            $data_rozdeniia = Carbon::parse($item['data_rozdeniia'])->format('Y-m-d');
            $snils = preg_replace('/[-\s]/', '', $item['snils']);

            $sfrperson = SfrPerson::where('pinn', $item['inn'])->orWhere('psnils', $snils)->first();

            if (!is_null($sfrperson)) {
                $sfrperson->psurname = $fio[0];
                $sfrperson->pname = $fio[1];
                $sfrperson->pmiddlename = $fio[2];
                $sfrperson->pbirthdate = $data_rozdeniia;
                $sfrperson->psnils = $snils;
                $sfrperson->pinn = $item['inn'];
                $sfrperson->save();
            } else {
                $sfrperson = new SfrPerson;
                $sfrperson->pinn = $item['inn'];
                $sfrperson->psurname = $fio[0];
                $sfrperson->pname = $fio[1];
                $sfrperson->pmiddlename = $fio[2];
                $sfrperson->pbirthdate = $data_rozdeniia;
                $sfrperson->psnils = $snils;
                $sfrperson->pcreatedon = Carbon::now('Europe/Moscow')->toDateTimeString();
                $sfrperson->save();

                $log_context = [
                    'action' => LogActionsEnum::LOG_PERSON_ADD(),
                    'sfrperson' => $sfrperson,
                    'fio' => $item['sotrudnikfiziceskoe_lico'],
                ];
                Log::info('Добавлен работник', $log_context);
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