<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class SFRVipnetCUSImportXML
{
    public function import($filename, $storage)
    {
        if (Storage::disk($storage)->exists($filename)) {
            $xmlString = Storage::disk($storage)->get($filename);
            $xmlData = simplexml_load_string($xmlString);
            $client = $xmlData->xpath('//report/coordinator/client');

            foreach ($client as $element) {
                $str_to_dump = sprintf('id: %s name: %s', $element->attributes()->id, $element->attributes()->name);
                dump($str_to_dump);
            }
        }
    }

}
