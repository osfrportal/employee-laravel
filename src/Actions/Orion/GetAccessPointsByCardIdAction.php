<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Orion;
use Lorisleiva\Actions\Concerns\AsAction;


use Osfrportal\OsfrportalLaravel\Data\Orion\TKeyData;
use Osfrportal\OsfrportalLaravel\Data\Orion\TAccessLevelData;
use Osfrportal\OsfrportalLaravel\Data\Orion\TAccessLevelItemData;
use Osfrportal\OsfrportalLaravel\Models\SfrOrionCards;
use Illuminate\Database\Eloquent\ModelNotFoundException; 

class GetAccessPointsByCardIdAction
{
    use AsAction;

    public function handle(int $cardId) {
        try {
            $cardData = SfrOrionCards::where('keyid', $cardId)->firstOrFail();
            foreach ($cardData->OrionAccessLevel->taccessleveldata as $accessLevel)
            {
                dump($accessLevel->toArray());
            }
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

}