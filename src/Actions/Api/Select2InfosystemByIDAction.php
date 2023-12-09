<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Api;

use Lorisleiva\Actions\Concerns\AsAction;
use Osfrportal\OsfrportalLaravel\Models\SfrInfoSystems;
use Osfrportal\OsfrportalLaravel\Http\Resources\SFRSelect2InfosystemByIDCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

class Select2InfosystemByIDAction
{
    use AsAction;

    public function handle($isysid)
    {
        $infosystemCollection = new Collection();

        $infosystem = SfrInfoSystems::where(['isysid', $isysid])->firstOrFail();
        $tmp_arr = [];
        $tmp_arr = Arr::add($tmp_arr, 'id', $infosystem->isysid);
        $tmp_arr = Arr::add($tmp_arr, 'text', $infosystem->isys_name);
        $infosystemCollection->push($tmp_arr);

        $api_data = $infosystemCollection->values()->all();

        return new SFRSelect2InfosystemByIDCollection($api_data);
    }

}
