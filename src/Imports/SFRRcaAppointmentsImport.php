<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;


use Osfrportal\OsfrportalLaravel\Models\SfrAppointment;

class SFRRcaAppointmentsImport
{
    public function import($filename, $storage)
    {
        if (Storage::disk($storage)->exists($filename)) {
            $xmlString = Storage::disk($storage)->get($filename);
            $xmlData = simplexml_load_string($xmlString);
            $appointments = $xmlData->xpath('//Post/Post');
            foreach ($appointments as $appointment)
            {
                $appointmentID = (string)$appointment->id;
                $appointmentName = (string)$appointment->Name;
                $modelAppointment = SfrAppointment::where('aname',$appointmentName)->first();
                if ($modelAppointment->count() > 0) {
                    $strout = sprintf('Name: %s - Found: %s', $appointmentName, $modelAppointment->aid);
                } else {
                    $strout = sprintf('NOT FOUND: %s - %s', $appointmentName,  $appointmentID);
                }
                dump($strout);
            }
        }
    }
}
