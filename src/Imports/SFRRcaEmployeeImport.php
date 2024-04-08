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
                dump($person->state);
                if (Str::is($person->state[0], 'Работает')) {
                    $worked++;
                }
                if (Str::is($person->state[0], 'Уволен')) {
                    $fired++;
                }
                //dump($person);
            }
            dump($worked, $fired);
        }
    }
}