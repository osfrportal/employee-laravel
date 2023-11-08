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
        $collectionSigns->pull('282fabe9-eae9-4821-87ed-237da2c06886');
        $collectionDocs->dump();
        $collectionSigns->dump();
        $diffCollection = $collectionDocs->diff($collectionSigns);
        dump($diffCollection);
        dump($diffCollection->count());
    }
}
