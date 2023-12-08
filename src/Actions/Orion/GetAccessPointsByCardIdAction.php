<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Orion;
use Lorisleiva\Actions\Concerns\AsAction;


use Osfrportal\OsfrportalLaravel\Data\Orion\TKeyData;
use Osfrportal\OsfrportalLaravel\Data\Orion\TAccessLevelData;
use Osfrportal\OsfrportalLaravel\Data\Orion\TAccessLevelItemData;
use Osfrportal\OsfrportalLaravel\Models\SfrOrionCards;
use Osfrportal\OsfrportalLaravel\Models\SfrOrionEntryPoints;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Osfrportal\OsfrportalLaravel\Http\Resources\OrionAccessPointsByCardIdCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

class GetAccessPointsByCardIdAction
{
    use AsAction;

    public function handle(int $cardId) {
        $accessPointsCollection = collect();
        try {
            $cardData = SfrOrionCards::where('keyid', $cardId)->firstOrFail();
            foreach ($cardData->OrionAccessLevel->taccessleveldata->Items as $accessLevelItem)
            {
                if (($accessLevelItem->ItemId == 0))
                {
                    return 999;
                }
                if (($accessLevelItem->ItemType == 'ACCESSPOINT'))
                {
                    //dump($accessLevelItem);
                    $entryPointData = SfrOrionEntryPoints::where('entrypointid', $accessLevelItem->ItemId)->firstOrFail();
                    $accessPointsCollection->push(['entrypointname' => $entryPointData->tentrypointdata->Name]);
                }
            }

            return new OrionAccessPointsByCardIdCollection($accessPointsCollection->sortBy(['entrypointname'])->values()->all());
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

}
