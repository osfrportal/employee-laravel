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
                $collectionDocs->push([
                    'fileid' => $f['fileid'],
                ]);
            }
            foreach ($doc->SfrDocsUserSigns as $s) {
                $collectionSigns->push([
                    'fileid' => $s['sign_fileid'],
                ]);
            }
        }
        $collectionDocs->dump();
        $collectionSigns->dump();
        $diffCollection = $collectionDocs->diffAssoc($collectionSigns);
        dump($diffCollection);
    }
}
