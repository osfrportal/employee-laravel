<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

class SFRRcaEmployeeImport
{
    public function import($filename, $storage)
    {
        if (Storage::disk($storage)->exists($filename)) {
            $xmlString = Storage::disk($storage)->get($filename);
            $xmlData = simplexml_load_string($xmlString);
            $units = $xmlData->xpath('//Persons/Person');
            foreach ($persons as $person) {
                dump($person);
            }
        }
    }
}