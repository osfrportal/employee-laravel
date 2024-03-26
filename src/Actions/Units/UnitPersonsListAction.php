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
     * @return \Spatie\LaravelData\DataCollection|array
     */
    public function handle(SfrUnits $unitData, bool $withoutAppMOP = false): DataCollection|array
    {
        $persons = [];

        $pers = $unitData->SfrPersons;
        foreach ($pers as $person) {
            $personDataModel = SFRPersonData::fromModel($person);
            if ($withoutAppMOP) {
                if ($personDataModel->persondata_appmop === false) {
                    $persons[] = $personDataModel;
                }
            } else {
                $persons[] = $personDataModel;
            }
        }

        return SFRPersonData::collect($persons);
    }
}
