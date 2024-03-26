<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Units;

use Lorisleiva\Actions\Concerns\AsAction;

use Osfrportal\OsfrportalLaravel\Models\SfrUnits;
use Osfrportal\OsfrportalLaravel\Data\SFRPersonData;

use Spatie\LaravelData\DataCollection;

/**
 * Работники подразделения
 */
class UnitPersonsListAction
{
    use AsAction;
    /**
     * Работники подразделения
     * @param SfrUnits $unitData
     * @param bool $withoutAppMOP
     * @param bool $withoutDekret
     * @return \Spatie\LaravelData\DataCollection|array
     */
    public function handle(SfrUnits $unitData, bool $withoutAppMOP = false, bool $withoutDekret = false): DataCollection|array
    {
        $persons = [];

        $pers = $unitData->SfrPersons;
        foreach ($pers as $person) {
            $personDataModel = SFRPersonData::fromModel($person);
            if ($withoutAppMOP) {
                if ($personDataModel->persondata_appmop === false) {
                    if ($withoutDekret) {
                        if ($personDataModel->persondata_dekret === null) {
                            $persons[] = $personDataModel;
                        }
                    } else {
                        $persons[] = $personDataModel;
                    }
                }
            } else {
                if ($withoutDekret) {
                    if ($personDataModel->persondata_dekret === null) {
                        $persons[] = $personDataModel;
                    }
                } else {
                    $persons[] = $personDataModel;
                }
            }
        }

        return SFRPersonData::collect($persons);
    }
}
