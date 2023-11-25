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
     * @return \Spatie\LaravelData\DataCollection
     */
    public function handle(SfrUnits $unitData) : DataCollection
    {
        $persons = [];

        $pers = $unitData->SfrPersons;
        foreach ($pers as $person) {
            $persons[] = SFRPersonData::fromModel($person);
        }

        return SFRPersonData::collection($persons);
    }
}
