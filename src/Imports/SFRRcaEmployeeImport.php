<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class SFRRcaEmployeeImport
{
    public function import($filename, $storage)
    {
        $worked = 0;
        $fired = 0;
        if (Storage::disk($storage)->exists($filename)) {
            $xmlString = Storage::disk($storage)->get($filename);
            $xmlData = simplexml_load_string($xmlString);
            $persons = $xmlData->xpath('//Persons/Person');
            foreach ($persons as $person) {
                if (Str::is($person->state[0]->__toString(), 'Работает')) {
                    $worked++;
                }
                if (Str::is($person->state[0]->__toString(), 'Уволен')) {
                    $fired++;
                }
                //dump($person);
            }
            dump($worked, $fired);
        }
    }
}