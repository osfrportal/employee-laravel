<?php

namespace Osfrportal\OsfrportalLaravel\Data;

use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Spatie\LaravelData\Data;
use Carbon\Carbon;

class SFRPersonData extends Data
{
    public function __construct(
        public ?string $persondata_pid = null,
        public ?string $persondata_tabnum = null,
        public ?string $persondata_psurname = null,
        public ?string $persondata_pname = null,
        public ?string $persondata_pmiddlename = null,
        public ?string $persondata_appointment = null,
        public ?string $persondata_unit_name = null,
        public ?string $persondata_vacation = null,
        public ?string $persondata_vacation_end = null,
        public ?string $persondata_dekret = null,
        public ?string $persondata_dekret_end = null,
        public ?string $persondata_absence = null,
        public ?string $persondata_absence_end = null,
        public ?string $persondata_fullname = null,
        public ?string $persondata_birthday = null,
        public ?string $persondata_inn = null,
        public ?string $persondata_snils = null,
        //public ?string $persondata_= null,
    ) {
    }

    public static function defValues(): SFRPersonData
    {
        return new self(
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );
    }

    public static function fromModel(SfrPerson $person): self
    {
        $personVacation = $person->getPersonVacationNow();
        if (!is_null($personVacation)) {
            $personVacationFormatted = sprintf("%s - %s", Carbon::parse($personVacation->vacationstart)->format('d.m.Y'), Carbon::parse($personVacation->vacationend)->format('d.m.Y'));
            $personVacationEndFormatted = Carbon::parse($personVacation->vacationend)->format('d.m.Y');
        } else {
            $personVacationFormatted = null;
            $personVacationEndFormatted = null;
        }

        $personDekret = $person->getPersonDekretNow();
        if (!is_null($personDekret)) {
            $personDekretFormatted = sprintf("%s - %s", Carbon::parse($personDekret->dekretstart)->format('d.m.Y'), Carbon::parse($personDekret->dekretend)->format('d.m.Y'));
            $personDekretEndFormatted = Carbon::parse($personDekret->dekretend)->format('d.m.Y');
        } else {
            $personDekretFormatted = null;
            $personDekretEndFormatted = null;
        }

        $personAbsence = $person->getPersonAbsenceNow();
        if (!is_null($personAbsence)) {
            $personAbsenceFormatted = sprintf("%s - %s", Carbon::parse($personAbsence->absencestart)->format('d.m.Y'), Carbon::parse($personAbsence->absenceend)->format('d.m.Y'));
            $personAbsenceEndFormatted = Carbon::parse($personAbsence->absenceend)->format('d.m.Y');
        } else {
            $personAbsenceFormatted = null;
            $personAbsenceEndFormatted = null;
        }

        return new self(
            persondata_pid: $person->getPid(),
            persondata_tabnum: $person->getTabNum(),
            persondata_psurname: $person->psurname,
            persondata_pname: $person->pname,
            persondata_pmiddlename: $person->pmiddlename,
            persondata_appointment: $person->getAppointment(),
            persondata_unit_name: $person->getUnit(),
            persondata_vacation: $personVacationFormatted,
            persondata_vacation_end: $personVacationEndFormatted,
            persondata_dekret: $personDekretFormatted,
            persondata_dekret_end: $personDekretEndFormatted,
            persondata_absence: $personAbsenceFormatted,
            persondata_absence_end: $personAbsenceEndFormatted,
            persondata_inn: $person->getINN(),
            persondata_snils: $person->getSNILS(),
            persondata_birthday: $person->getBirthDate(),
            persondata_fullname: $person->getFullName(),
        );
    }
}
