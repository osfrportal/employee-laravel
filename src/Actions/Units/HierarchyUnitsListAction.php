<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Units;

use Lorisleiva\Actions\Concerns\AsAction;
use Osfrportal\OsfrportalLaravel\Data\SFRUnitData;
use Osfrportal\OsfrportalLaravel\Models\SfrUnits;

class HierarchyUnitsListAction
{
    use AsAction;

    /**
     * Возвращает иерархическую структуру SFRUnitData с коллекцией дочерними подразделениями
     * Если параметр не передан - выводится структура с родительскими подразделениями.
     * Если параметр передан - выводится информация по запрошенным юнитам.
     * @param array $unitsIds
     * @return SFRUnitData
     */
    public function handle($unitsIds = []) {
        $unitsCollection = collect();
        //if (is_array($unitsIds) && count($unitsIds) > 0) {
          //  $allRootUnits = SfrUnits::whereIn('unitid', $unitsIds)->orderBy('unitsortorder', 'ASC')->orderBy('unitname', 'ASC')->get();
        //} else {
            $allRootUnits = SfrUnits::whereNull('unitparentid')->orderBy('unitsortorder', 'ASC')->orderBy('unitname', 'ASC')->get();
        //}
        foreach ($allRootUnits as $rootUnit) {
            $unitData = [
                'unitid' => $rootUnit->unitid,
                'unitname' => $rootUnit->unitname,
                'unitcode' => $rootUnit->unitcode,
                'unitnameshort' => $rootUnit->unitnameshort,
                'unitparentid' => $rootUnit->unitparentid,
                'unitsortorder' => $rootUnit->unitsortorder,
                'persons_count' => $rootUnit->persons_count,
                'children_count' => $rootUnit->children_count,
            ];
            $childUnits = [];
            if ($rootUnit->children_count > 0) {
                foreach ($rootUnit->children as $childUnit) {
                    $childUnits[] = [
                        'unitid' => $childUnit->unitid,
                        'unitname' => $childUnit->unitname,
                        'unitcode' => $childUnit->unitcode,
                        'unitnameshort' => $childUnit->unitnameshort,
                        'unitparentid' => $childUnit->unitparentid,
                        'unitsortorder' => $childUnit->unitsortorder,
                        'persons_count' => $childUnit->persons_count,
                    ];
                }
                $unitData = Arr::prepend($unitData, SFRUnitData::collection($childUnits), 'childunits');
            }
            $unitsCollection->push(SFRUnitData::from($unitData));
        }
        return $unitsCollection;
    }
}