<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;

class SFRRcaAppointmentsImport
{
    public function import($filename, $storage)
    {
        if (Storage::disk($storage)->exists($filename)) {
            $xmlString = Storage::disk($storage)->get($filename);
            $xmlData = simplexml_load_string($xmlString);
            $appointments = $xmlData->xpath('//Post/Post');
            dump($appointments);
            foreach ($appointments as $appointment)
            {
                $appointmentID = (string)$appointment->attributes()->id;
                $appointmentName = $appointment->attributes()->Name;
                dump($appointmentID);
                dump($appointmentName);
            }
        }
    }
}
