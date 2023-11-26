<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Api;

use Lorisleiva\Actions\Concerns\AsAction;

use Osfrportal\OsfrportalLaravel\Models\SfrDocs;
use Osfrportal\OsfrportalLaravel\Models\SfrDocGroups;
use Osfrportal\OsfrportalLaravel\Http\Resources\SFRSelect2DocsAllCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

class Select2DocsAllAction
{
    use AsAction;
    public $sfr_docs_select2_collection;

    public function handle()
    {
        SfrDocGroups::with(['SfrDocs'])->get()->each(function ($item, $key) {
            dump($item);
        });

        $this->sfr_docs_select2_collection = new Collection();

        SfrDocs::with(['docGroup', 'docType'])->get()->each(function ($item, $key) {
            $tmp_arr = [];
            $tmp_arr = Arr::add($tmp_arr, 'id', $item->docid);
            $tmp_arr = Arr::add($tmp_arr, 'text', sprintf('%s №%s от %s - %s', $item->docType->type_name, $item->doc_number, $item->doc_date, $item->doc_name));
            $this->sfr_docs_select2_collection->push($tmp_arr);
        });
        $api_data = $this->sfr_docs_select2_collection->sortBy(['text'])->values()->all();

        return new SFRSelect2DocsAllCollection($api_data);
    }

}
