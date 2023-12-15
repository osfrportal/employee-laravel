<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\XML;

class SFRVipnetCUSImportXML
{
    public function import($filename, $storage)
    {
        if (Storage::disk($storage)->exists($filename)) {
            $xmlString = Storage::disk($storage)->get($filename);
            $xmlData = XML::parse($xmlString);

            foreach ($xmlData['coordinator']['client'] as $element) {
                dump($element);
            }
        }
    }

}
