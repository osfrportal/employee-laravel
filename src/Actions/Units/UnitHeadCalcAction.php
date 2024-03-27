<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Units;

use Lorisleiva\Actions\Concerns\AsAction;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;

/**
 * Вычисление линейных руководителей и заместителей для подразделения
 */
class UnitHeadCalcAction
{
    use AsAction;
    /**
     * Возвращает список руководителей подразделения по ID
     * @param string $unitId
     * @return void
     */
    public function handle(string $unitId)
    {
        //9a06e58a-6aa3-40ba-bc80-0f0b74280f66
        //выбираем работников подразделения с признаком aheadofunit в таблице должностей
        $persons = SfrPerson::whereRelation('SfrPersonUnit', 'unitid', $unitId)->whereRelation('SfrPersonAppointment', 'aheadofunit', true)->get();
        dump($persons);
    }
}