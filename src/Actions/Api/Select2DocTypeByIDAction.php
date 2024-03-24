<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Api;

use Lorisleiva\Actions\Concerns\AsAction;
use Osfrportal\OsfrportalLaravel\Models\SfrDocTypes;
use Osfrportal\OsfrportalLaravel\Http\Resources\SFRSelect2DocTypeByIDCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Select2DocTypeByIDAction
{
    use AsAction;

    public function handle($typeid)
    {
        $isUuid = Str::isUuid($typeid);
        if ($isUuid) {
            $collection = new Collection();

            $doctype = SfrDocTypes::where('typeid', $typeid)->firstOrFail();
            $tmp_arr = [];
            $tmp_arr = Arr::add($tmp_arr, 'id', $doctype->typeid);
            $tmp_arr = Arr::add($tmp_arr, 'text', $doctype->type_name);
            $collection->push($tmp_arr);

            $api_data = $collection->values()->all();
        } else {
            $api_data = [];
        }
        return new SFRSelect2DocTypeByIDCollection($api_data);

    }

}
