<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class SFRVipnetCUSImportXML
{
    private function SimpleXML2Array($xml){
        $array = (array)$xml;

        //recursive Parser
        foreach ($array as $key => $value){
            //if(strpos(get_class($value),"SimpleXML")!==false){
                $array[$key] = $this->SimpleXML2Array($value);
            //}
        }

        return $array;
    }
    public function import($filename, $storage)
    {
        if (Storage::disk($storage)->exists($filename)) {
            $xmlString = Storage::disk($storage)->get($filename);
            $xmlData = simplexml_load_string($xmlString);
            $client = $xmlData->xpath('//report/coordinator/client');

            foreach ($client as $element) {
                $str_to_dump = sprintf('id: %s name: %s', $element->attributes()->id, $element->attributes()->name);
                dump($str_to_dump);
                $roles = $element->xpath('role');
                foreach ($roles as $role) {
                    $str_role_to_dump = sprintf('id: %s name: %s', $role->attributes()->id, $role->attributes()->name);
                    dump($str_role_to_dump);
                }
                $rolesArray = (array)$roles;
                dump($rolesArray);

            }
        }
    }

}
