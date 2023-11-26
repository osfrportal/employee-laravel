<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Api;

use Lorisleiva\Actions\Concerns\AsAction;

use Osfrportal\OsfrportalLaravel\Models\SfrUnits;
use Osfrportal\OsfrportalLaravel\Http\Resources\SFRSelect2UnitsAllCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

class Select2UnitsAllAction
{
    use AsAction;
    public $sfr_units_select2_collection;

    public function handle()
    {
        $this->sfr_units_select2_collection = new Collection();

        SfrUnits::all()->each(function ($item, $key) {
            $tmp_arr = [];
            $tmp_arr = Arr::add($tmp_arr, 'id', $item->unitid);
            $tmp_arr = Arr::add($tmp_arr, 'text', $item->unitname);
            if ($item->persons_count < 1) {
                $tmp_arr = Arr::add($tmp_arr, 'disabled', true);
            }
            if ($item->persons_count > 0) {
                $this->sfr_units_select2_collection->push($tmp_arr);
            }
        });
        $api_data = $this->sfr_units_select2_collection->sortBy(['text'])->values()->all();

        return new SFRSelect2UnitsAllCollection($api_data);
    }

}
