<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Orion;
use Lorisleiva\Actions\Concerns\AsAction;


use Osfrportal\OsfrportalLaravel\Data\Orion\TKeyData;
use Osfrportal\OsfrportalLaravel\Data\Orion\TAccessLevelData;
use Osfrportal\OsfrportalLaravel\Data\Orion\TAccessLevelItemData;
use Osfrportal\OsfrportalLaravel\Models\SfrOrionCards;
class GetAccessPointsByCardIdAction
{
    use AsAction;

    public function handle(int $cardId) {
        $cardData = SfrOrionCards::where('keyid',$cardId)->firstOrFail;
        dump($cardData->OrionAccessLevel->taccessleveldata);
    }

}