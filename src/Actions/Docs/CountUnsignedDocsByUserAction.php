<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Docs;

use Lorisleiva\Actions\Concerns\AsAction;

use Osfrportal\OsfrportalLaravel\Models\SfrDocs;

use Carbon\Carbon;

use Osfrportal\OsfrportalLaravel\Data\SFRDocData;
use Illuminate\Support\Facades\Auth;

class CountUnsignedDocsByUserAction
{
    use AsAction;

    public function handle()
    {
        $allDocs = SfrDocs::where('doc_data->docNeedSign', true)->with(['SfrDocsFiles', 'SfrDocsUserSigns'])->get();
        $collectionDocs = collect();
        $collectionSigns = collect();
        $personWorkStartDate = Auth::user()->SfrPerson->getWorkStartDateCarbon();

        foreach ($allDocs as $doc) {
            $docDataDTO = SFRDocData::forList($doc);
            $docDateEndCarbon = Carbon::parse($docDataDTO->docDateEnd);
            if ($docDateEndCarbon->gte($personWorkStartDate)) {
                foreach ($doc->SfrDocsFiles as $f) {
                    $collectionDocs->push($f['fileid']);
                }
                foreach ($doc->SfrDocsUserSigns as $s) {
                    $collectionSigns->push($s['sign_fileid']);
                }
            }
        }
        $diffCollection = $collectionDocs->diff($collectionSigns);
        return $diffCollection->count();
    }
}
