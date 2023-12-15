<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;
use SingleQuote\LaravelXmlParser\XML;
use Illuminate\Support\Facades\Storage;
use SingleQuote\LaravelXmlParser\Transformers\ArrayTransformer;

class SFRVipnetCUSImportXML
{
    public function import($filename, $storage)
    {
        if (Storage::disk($storage)->exists($filename)) {
            $path = Storage::disk($storage)->path($filename);
            $xml = XML::import($path)->transform('client')->with(ArrayTransformer::class)->get();
            dump($xml->coordinator->client);
        }
    }

}
