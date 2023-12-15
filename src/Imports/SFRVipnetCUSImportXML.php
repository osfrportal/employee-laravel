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
            $client = $xml->xpath('//report/coordinator/client');

            foreach ($client as $element) {
                dump($element);
            }
        }
    }

}
