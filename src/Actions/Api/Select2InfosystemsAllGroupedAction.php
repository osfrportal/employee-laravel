<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Api;

use Lorisleiva\Actions\Concerns\AsAction;
use Osfrportal\OsfrportalLaravel\Models\SfrInfoSystems;
use Osfrportal\OsfrportalLaravel\Http\Resources\SFRSelect2InfosystemsAllGroupedCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

class Select2InfosystemsAllGroupedAction
{
    use AsAction;
    public $sfrInfosystemsSelect2Collection;
    public $sfrInfosystemsGroupedSelect2Collection;

    public function handle()
    {
        $this->sfrInfosystemsGroupedSelect2Collection = new Collection();

        SfrInfoSystems::with(['children'])->get()->each(function ($item, $key) {
            if ($item->children->count() > 0) {
                $this->sfrInfosystemsSelect2Collection = new Collection();
                foreach ($item->children as $children) {
                    $tmp_arr = [];
                    $tmp_arr = Arr::add($tmp_arr, 'id', $children->isysid);
                    $tmp_arr = Arr::add($tmp_arr, 'text', $children->isys_name);
                    $this->sfrInfosystemsSelect2Collection->push($tmp_arr);
                }
                $tmpGroupArr = [];
                $tmpGroupArr = Arr::add($tmpGroupArr, 'text', $item->isys_name);
                $tmpGroupArr = Arr::add($tmpGroupArr, 'children', $this->sfrInfosystemsSelect2Collection);
                $this->sfrInfosystemsGroupedSelect2Collection->push($tmpGroupArr);
            }
        });

        $api_data = $this->sfrInfosystemsGroupedSelect2Collection->sortBy(['text'])->values()->all();

        return new SFRSelect2InfosystemsAllGroupedCollection($api_data);
    }

}
