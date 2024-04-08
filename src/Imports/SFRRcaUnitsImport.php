<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;


use Osfrportal\OsfrportalLaravel\Models\SfrAppointment;

class SFRRcaUnitsImport
{
    public function import($filename, $storage)
    {
        if (Storage::disk($storage)->exists($filename)) {
            $xmlString = Storage::disk($storage)->get($filename);
            $xmlData = simplexml_load_string($xmlString);
            $units = $xmlData->xpath('//Org/ORG');
            foreach ($units as $unit) {
                $unitID = Str::of((string) $unit->id)->afterLast('-');
                $unitName = (string) $unit->Name;
                $unitParentID = Str::of((string) $unit->ParentCode)->afterLast('-');
                $strout = sprintf('%s - %s - %s', $unitID, $unitName, $unitParentID);
                dump($strout);
            }
        }
    }
}
