<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Api;

use Lorisleiva\Actions\Concerns\AsAction;
use Osfrportal\OsfrportalLaravel\Models\SfrDocGroups;
use Osfrportal\OsfrportalLaravel\Http\Resources\SFRSelect2DocGroupByIDCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Select2DocGroupByIDAction
{
    use AsAction;

    public function handle($groupid)
    {
        $isUuid = Str::isUuid($groupid);
        if ($isUuid) {
            $collection = new Collection();

            $docgroup = SfrDocGroups::where('groupid', $groupid)->firstOrFail();
            $tmp_arr = [];
            $tmp_arr = Arr::add($tmp_arr, 'id', $docgroup->groupid);
            $tmp_arr = Arr::add($tmp_arr, 'text', $docgroup->group_name);
            $collection->push($tmp_arr);

            $api_data = $collection->values()->all();
        } else {
            $api_data = [];
        }
        return new SFRSelect2DocGroupByIDCollection($api_data);

    }

}
