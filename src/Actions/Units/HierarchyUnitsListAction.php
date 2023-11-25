<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Units;

use Lorisleiva\Actions\Concerns\AsAction;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

use Osfrportal\OsfrportalLaravel\Data\SFRUnitData;
use Osfrportal\OsfrportalLaravel\Models\SfrUnits;

use Osfrportal\OsfrportalLaravel\Actions\Units\UnitPersonsListAction;
/**
 * Возврат иерархической структуры подразделений
 */
class HierarchyUnitsListAction
{
    use AsAction;

    /**
     * Возвращает иерархическую структуру SFRUnitData с коллекцией дочерними подразделениями
     * Если параметр unitsIds передан true - выводится информация по запрошенным юнитам.
     * Если параметр withChildren передан true - выводится структура с дочерними подразделениями.
     * Если параметр withSfrPersonData передан true - выводится информация по работникам подразделения
     * @param array $unitsIds
     * @param bool $withChildren
     * @param bool $withSfrPersonData
     * @return SFRUnitData
     */
    public function handle($unitsIds = [], $withChildren = true, $withSfrPersonData = false) {
        $unitsCollection = collect();
        if (is_array($unitsIds) && count($unitsIds) > 0) {
            $allRootUnits = SfrUnits::whereIn('unitid', $unitsIds)->orderBy('unitsortorder', 'ASC')->orderBy('unitname', 'ASC')->get();
        } else {
            $allRootUnits = SfrUnits::whereNull('unitparentid')->orderBy('unitsortorder', 'ASC')->orderBy('unitname', 'ASC')->get();
        }
        foreach ($allRootUnits as $rootUnit) {
            $unitRootPersons = UnitPersonsListAction::run($rootUnit);
            dump($unitRootPersons);
            $unitData = [
                'unitid' => $rootUnit->unitid,
                'unitname' => $rootUnit->unitname,
                'unitcode' => $rootUnit->unitcode,
                'unitnameshort' => $rootUnit->unitnameshort,
                'unitparentid' => $rootUnit->unitparentid,
                'unitsortorder' => $rootUnit->unitsortorder,
                'persons_count' => $rootUnit->persons_count,
                'unitpersons' => $unitRootPersons,
            ];
            if ($withChildren) {
                $childUnits = [];
                if (count($rootUnit->children) > 0) {
                    foreach ($rootUnit->children as $childUnit) {
                        $unitChildPersons = UnitPersonsListAction::run($childUnit);

                        $childUnits[] = [
                            'unitid' => $childUnit->unitid,
                            'unitname' => $childUnit->unitname,
                            'unitcode' => $childUnit->unitcode,
                            'unitnameshort' => $childUnit->unitnameshort,
                            'unitparentid' => $childUnit->unitparentid,
                            'unitsortorder' => $childUnit->unitsortorder,
                            'persons_count' => $childUnit->persons_count,
                            'unitpersons' => $unitChildPersons,
                        ];
                    }
                    $unitData = Arr::prepend($unitData, SFRUnitData::collection($childUnits), 'childunits');
                }
            }
            $unitsCollection->push(SFRUnitData::from($unitData));
        }
        return $unitsCollection;
    }
}