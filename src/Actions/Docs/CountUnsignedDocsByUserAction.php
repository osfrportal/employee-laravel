<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Docs;

use Lorisleiva\Actions\Concerns\AsAction;

use Osfrportal\OsfrportalLaravel\Models\SfrDocs;

class CountUnsignedDocsByUserAction
{
    use AsAction;

    public function handle()
    {
        $allDocs = SfrDocs::where('doc_data->docNeedSign', true)->with(['SfrDocsFiles', 'SfrDocsUserSigns'])->get();
        $collectionDocs = collect();
        $collectionSigns = collect();
        
        foreach ($allDocs as $doc) {
            foreach ($doc->SfrDocsFiles as $f) {
                $collectionDocs->push($f['fileid']);
            }
            foreach ($doc->SfrDocsUserSigns as $s) {
                $collectionSigns->push($s['sign_fileid']);
            }
        }
        $diffCollection = $collectionDocs->diff($collectionSigns);
        return $diffCollection->count();
    }
}
