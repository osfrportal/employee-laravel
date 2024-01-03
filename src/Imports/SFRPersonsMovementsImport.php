<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
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
use Osfrportal\OsfrportalLaravel\Enums\PersonsMovementsEnum;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Models\SfrUnits;
use Osfrportal\OsfrportalLaravel\Models\SfrAppointment;
use Osfrportal\OsfrportalLaravel\Data\SFRPersonMovementData;

class SFRPersonsMovementsImport implements ToCollection, WithCustomCsvSettings, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    private $enumMovementsArray;

    public function __construct()
    {
        $this->enumMovementsArray = array_flip(PersonsMovementsEnum::toArray());
    }
    public function rules(): array
    {
        return [
            'sotrudnikfiziceskoe_lico_snils' => 'required',
            'podrazdelenie' => 'required',
            'dolznost' => 'required',
            'vid_sobytiia' => 'required',
            'period' => 'required:date',
        ];
    }

    public function collection(Collection $collection)
    {
        $collection->each(function ($item) {
            $sotrudnikfiziceskoe_lico_snils = explode(",", $item['sotrudnikfiziceskoe_lico_snils']);
            $personFullFIO = $sotrudnikfiziceskoe_lico_snils[0];
            $personSnils = trim(preg_replace('/[-\s]/', '', $sotrudnikfiziceskoe_lico_snils[1]));
            $personDepartmentNew = trim($item['podrazdelenie']);
            $personAppointmentNew = trim($item['dolznost']);
            $personStatus = new PersonsMovementsEnum(Arr::get($this->enumMovementsArray, $item['vid_sobytiia'], 0));
            //$personStatus = Arr::get($this->enumMovementsArray, $item['vid_sobytiia'], 0);
            $personMovementDate = Carbon::createFromFormat('d.m.Y', $item['period']);
            $movementPid = null;
            $movementAppointmentNewID = null;
            $movementDepartmentNewID = null;

            $personDB = SfrPerson::where('psnils', $personSnils)->first();
            $appointmentDB = SfrAppointment::where('aname', $personAppointmentNew)->first();
            $departmentDB = SfrUnits::where('unitname', $personDepartmentNew)->first();
            if ($personDB) {
                $movementPid = $personDB->pid;
            }
            if ($appointmentDB) {
                $movementAppointmentNewID = $appointmentDB->aid;
            }
            if ($departmentDB) {
                $movementDepartmentNewID = $departmentDB->unitid;
            }


            dump(new SFRPersonMovementData(movementType: $personStatus, movementPid: $movementPid, movementPersonFullFIO: $personFullFIO, movementDepartmentNew: $personDepartmentNew, movementDepartmentNewID: $movementDepartmentNewID, movementAppointmentNew: $personAppointmentNew, movementAppointmentNewID: $movementAppointmentNewID, movementSnils: $personSnils, movementEventDate: $personMovementDate));
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