<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Api;

use Lorisleiva\Actions\Concerns\AsAction;

use Osfrportal\OsfrportalLaravel\Models\SfrUnits;
use Illuminate\Support\Collection;


class Select2UnitsAllAction
{
    use AsAction;
    public $sfr_units_select2_collection;

    public function handle()
    {
        $this->sfr_units_select2_collection = new Collection();
        SfrUnits::all()->each(function ($item, $key) {
            $tmp_arr = [
                'id' => $item->unitid,
                'text' => $item->unitname,
            ];
            $this->sfr_units_select2_collection->push($tmp_arr);
        });
        $api_data['results'] = $this->sfr_units_select2_collection->sortBy(['text'])->values()->all();
        //return response()->json(data: $api_data, options: JSON_UNESCAPED_UNICODE);
        dump($api_data);
        //return $api_data;
    }

}
