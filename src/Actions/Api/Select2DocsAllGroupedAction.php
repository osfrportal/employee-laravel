<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Api;

use Lorisleiva\Actions\Concerns\AsAction;

use Osfrportal\OsfrportalLaravel\Models\SfrDocs;
use Osfrportal\OsfrportalLaravel\Models\SfrDocGroups;
use Osfrportal\OsfrportalLaravel\Http\Resources\SFRSelect2DocsAllGroupedCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

class Select2DocsAllGroupedAction
{
    use AsAction;
    public $sfrDocsSelect2Collection;
    public $sfrDocsGroupedSelect2Collection;

    public function handle()
    {
        $this->sfrDocsGroupedSelect2Collection = new Collection();

        SfrDocGroups::with(['SfrDocs'])->get()->each(function ($item, $key) {
            if ($item->sfr_docs_count > 0) {
                $this->sfrDocsSelect2Collection = new Collection();
                foreach ($item->SfrDocs as $sfrdoc) {
                    $tmp_arr = [];
                    $tmp_arr = Arr::add($tmp_arr, 'id', $sfrdoc->docid);
                    $tmp_arr = Arr::add($tmp_arr, 'text', sprintf('%s №%s от %s - %s', $sfrdoc->docType->type_name, $sfrdoc->doc_number, $sfrdoc->doc_date, $sfrdoc->doc_name));
                    $this->sfrDocsSelect2Collection->push($tmp_arr);
                }
                $tmpGroupArr = [];
                $tmpGroupArr = Arr::add($tmpGroupArr, 'text', $item->group_name);
                $tmpGroupArr = Arr::add($tmpGroupArr, 'children', $this->sfrDocsSelect2Collection);
            }
        });

        $api_data = $this->sfrDocsGroupedSelect2Collection->sortBy(['text'])->values()->all();

        return new SFRSelect2DocsAllGroupedCollection($api_data);
    }

}
