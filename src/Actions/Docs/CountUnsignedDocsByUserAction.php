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
            $doc->dump();
            foreach ($doc->SfrDocsUserSigns as $s) {
                $collectionSigns->push([
                    'sign_fileid' => $s['sign_fileid'],
                    'sign_pid' => $s['sign_pid']
                ]);
            }
        }
        $collectionSigns->dump();
    }
}
