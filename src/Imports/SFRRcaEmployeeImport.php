<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;

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
                $snils = preg_replace('/[-\s]/', '', $person->id[0]->__toString());
                $data_rozdeniia = Carbon::parse($person->dateofbirth[0]->__toString())->format('Y-m-d');


                if (Str::is($person->state[0]->__toString(), 'Работает')) {
                    $worked++;
                }
                if (Str::is($person->state[0]->__toString(), 'Уволен')) {
                    $sfrperson = SfrPerson::where('psnils', $snils)->first();
                    dump($sfrperson);
                    $fired++;
                }
                //dump($person);
            }
            dump($worked, $fired);
        }
    }
}