<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Facades\Storage;

class SFRRcaEmployeeImport
{
    public function import($filename, $storage)
    {
        if (Storage::disk($storage)->exists($filename)) {
            $xmlString = Storage::disk($storage)->get($filename);
            $xmlData = simplexml_load_string($xmlString);
            $persons = $xmlData->xpath('//Persons/Person');
            foreach ($persons as $person) {
                dump($person);
            }
        }
    }
}