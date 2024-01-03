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
use Osfrportal\OsfrportalLaravel\Models\SfrPersonMovements;
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
            $personMovementDate = Carbon::createFromFormat('d.m.Y', $item['period']);
            $movementPid = null;
            $movementAppointmentNewID = null;
            $movementDepartmentNewID = null;

            $personDB = SfrPerson::where('psnils', $personSnils)->first();
            $appointmentDBfromFile = SfrAppointment::where('aname', $personAppointmentNew)->first();
            $departmentDBfromFile = SfrUnits::where('unitname', $personDepartmentNew)->first();
            if ($personDB) {
                $movementPid = $personDB->pid;
            }
            if ($appointmentDBfromFile) {
                $movementAppointmentNewID = $appointmentDBfromFile->aid;
            }
            if ($departmentDBfromFile) {
                $movementDepartmentNewID = $departmentDBfromFile->unitid;
            }

            $movementData = new SFRPersonMovementData(movementType: $personStatus);
            $movementData->movementPid = $movementPid;
            $movementData->movementPersonFullFIO = $personFullFIO;
            if ($personStatus->equals(PersonsMovementsEnum::PersonFire())) {
                //проверяем, содержится ли указанная информация в базе для исключения дублирования
                $movementExists = SfrPersonMovements::where('movementdata->movementPid', $movementPid)
                    ->where('movementdata->movementDepartmentOld', $personDepartmentNew)
                    ->where('movementdata->movementDepartmentOldID', $movementDepartmentNewID)
                    ->where('movementdata->movementAppointmentOld', $personAppointmentNew)
                    ->where('movementdata->movementAppointmentOldID', $movementAppointmentNewID)
                    ->get();
                $movementData->movementDepartmentOld = $personDepartmentNew;
                $movementData->movementDepartmentOldID = $movementDepartmentNewID;
                $movementData->movementAppointmentOld = $personAppointmentNew;
                $movementData->movementAppointmentOldID = $movementAppointmentNewID;
            } elseif ($personStatus->equals(PersonsMovementsEnum::PersonMove())) {
                //проверяем, содержится ли указанная информация в базе для исключения дублирования
                $movementExists = SfrPersonMovements::where('movementdata->movementPid', $movementPid)
                    ->where('movementdata->movementDepartmentNew', $personDepartmentNew)
                    ->where('movementdata->movementDepartmentNewID', $movementDepartmentNewID)
                    ->where('movementdata->movementAppointmentNew', $personAppointmentNew)
                    ->where('movementdata->movementAppointmentNewID', $movementAppointmentNewID)
                    ->get();
                $movementData->movementDepartmentNew = $personDepartmentNew;
                $movementData->movementDepartmentNewID = $movementDepartmentNewID;
                $movementData->movementAppointmentNew = $personAppointmentNew;
                $movementData->movementAppointmentNewID = $movementAppointmentNewID;
                //на момент импорта в базе содержится информация о старой должности
                $movementData->movementDepartmentOld = ($personDB->getUnit() !== $personDepartmentNew ? $personDB->getUnit() : null);
                $movementData->movementDepartmentOldID = ($personDB->getUnitID() !== $movementDepartmentNewID ? $personDB->getUnitID() : null);
                $movementData->movementAppointmentOldID = ($personDB->getAppointmentID() !== $movementAppointmentNewID ? $personDB->getAppointmentID() : null);
                $movementData->movementAppointmentOld = ($personDB->getAppointment() !== $personAppointmentNew ? $personDB->getAppointment() : null);
            } else {
                //проверяем, содержится ли указанная информация в базе для исключения дублирования
                $movementExists = SfrPersonMovements::where('movementdata->movementPid', $movementPid)
                    ->where('movementdata->movementDepartmentNew', $personDepartmentNew)
                    ->where('movementdata->movementDepartmentNewID', $movementDepartmentNewID)
                    ->where('movementdata->movementAppointmentNew', $personAppointmentNew)
                    ->where('movementdata->movementAppointmentNewID', $movementAppointmentNewID)
                    ->get();
                $movementData->movementDepartmentNew = $personDepartmentNew;
                $movementData->movementDepartmentNewID = $movementDepartmentNewID;
                $movementData->movementAppointmentNew = $personAppointmentNew;
                $movementData->movementAppointmentNewID = $movementAppointmentNewID;
            }
            $movementData->movementSnils = $personSnils;

            dump($movementData);
            dump($movementExists);
            $movementToDBModel = new SfrPersonMovements();
            $movementToDBModel->pid = $movementPid;
            $movementToDBModel->movementdata = $movementData;
            $movementToDBModel->movementtype = $personStatus;
            $movementToDBModel->movementeventdate = $personMovementDate;
            //$movementToDBModel->save();
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