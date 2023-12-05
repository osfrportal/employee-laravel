<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Orion;
use Lorisleiva\Actions\Concerns\AsAction;


use Osfrportal\OsfrportalLaravel\Data\Orion\TKeyData;
use Osfrportal\OsfrportalLaravel\Data\Orion\TAccessLevelData;
use Osfrportal\OsfrportalLaravel\Data\Orion\TAccessLevelItemData;
use Osfrportal\OsfrportalLaravel\Models\SfrOrionCards;
use Osfrportal\OsfrportalLaravel\Models\SfrOrionEntryPoints;
use Illuminate\Database\Eloquent\ModelNotFoundException; 

class GetAccessPointsByCardIdAction
{
    use AsAction;

    public function handle(int $cardId) {
        try {
            $cardData = SfrOrionCards::where('keyid', $cardId)->firstOrFail();
            foreach ($cardData->OrionAccessLevel->taccessleveldata->Items as $accessLevelItem)
            {
                if ($accessLevelItem->ItemType == 'ACCESSPOINT')
                {
                    //dump($accessLevelItem);
                    $entryPointData = SfrOrionEntryPoints::where('entrypointid', $accessLevelItem->ItemId)->firstOrFail();
                    dump($entryPointData->tentrypointdata->Name);
                }
            }
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

}