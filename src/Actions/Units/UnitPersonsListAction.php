<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Units;

use Lorisleiva\Actions\Concerns\AsAction;


use Osfrportal\OsfrportalLaravel\Data\SFRUnitData;
use Osfrportal\OsfrportalLaravel\Data\SFRPersonData;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class UnitPersonsListAction
{
    use AsAction;
    
    public function handle($unitData) : DataCollection
    {
        $persons = [];

        $pers = $unitData->SfrPersons();
        foreach ($pers as $person) {
            $persons[] = SFRPersonData::fromModel($person);
        }

        return SFRPersonData::collection($persons);
    }
}
