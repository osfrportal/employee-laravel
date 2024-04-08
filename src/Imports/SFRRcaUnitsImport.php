<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;

use Osfrportal\OsfrportalLaravel\Models\SfrUnits;

class SFRRcaUnitsImport
{
    public function import($filename, $storage)
    {
        if (Storage::disk($storage)->exists($filename)) {
            $xmlString = Storage::disk($storage)->get($filename);
            $xmlData = simplexml_load_string($xmlString);
            $units = $xmlData->xpath('//Org/ORG');
            foreach ($units as $unit) {
                if ((!Str::is(trim($unit->id[0]), '058')) && (!Str::is(trim($unit->id[0]), '058-000'))) {
                    $unitID = Str::of(trim($unit->id[0]))->afterLast('-');
                    $unitName = trim($unit->Name[0]);
                    $unitParentID = Str::of(trim($unit->ParentCode[0]))->afterLast('-');
                    $modelUnit = SfrUnits::withTrashed()->where('unitname', $unitName)->first();
                    if (!is_null($modelUnit)) {
                        if ($modelUnit->trashed()) {
                            $strout = sprintf('TRASHED! Name: "%s" - Found: %s', $unitName, $modelUnit->unitid);
                        } else {
                            $strout = sprintf('Name: "%s" - Found: %s', $unitName, $modelUnit->unitid);
                        }
                    } else {
                        $strout = sprintf('NOT FOUND: "%s" - %s', $unitName, $unitID);
                    }
                    dump($strout);
                }
            }
        }
    }
}
