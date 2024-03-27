<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Units;

use Lorisleiva\Actions\Concerns\AsAction;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;

use Osfrportal\OsfrportalLaravel\Data\SFRPersonData;
use Spatie\LaravelData\DataCollection;

/**
 * Вычисление линейных руководителей и заместителей для подразделения
 */
class UnitHeadCalcAction
{
    use AsAction;
    /**
     * Возвращает список руководителей подразделения по ID
     * @param string $unitId
     * @return \Spatie\LaravelData\DataCollection|array
     */
    public function handle(string $unitId)
    {
        $personsOut = [];

        //выбираем работников подразделения с признаком aheadofunit в таблице должностей
        $persons = SfrPerson::whereRelation('SfrPersonUnit', 'punits.unitid', $unitId)->whereRelation('SfrPersonAppointment', 'pappointment.aheadofunit', true)->get();
        foreach ($persons as $person) {
            $personDataModel = SFRPersonData::fromModel($person);
            $personsOut[] = $personDataModel;
        }
        return SFRPersonData::collect($personsOut);
    }
}