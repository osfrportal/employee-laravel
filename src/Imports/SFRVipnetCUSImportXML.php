<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
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
            $clients = $xmlData->xpath('//report/coordinator/client');

            foreach ($clients as $client) {
                $roles = $client->xpath('role');
                $hasBusinessMail = false;
                foreach ($roles as $role) {
                    $roleID = $role->attributes()->id;
                    $roleName = $role->attributes()->name;
                    if ($roleID == '0000') {
                        $hasBusinessMail = true;
                        break;
                    }
                    //$str_role_to_dump = sprintf('id: %s name: %s', $roleID, $roleName);
                    //dump($str_role_to_dump);
                }
                if ($hasBusinessMail) {
                    $businessMailMessage = 'ДП:';
                } else {
                    $businessMailMessage = 'НЕТ ДП!';
                }
                $clientID = $client->attributes()->id;
                $clientName = Str::squish(Str::remove('058 - ', $client->attributes()->name));
                //$collection = Str::of($clientName)->explode(' ');
                preg_match('/^(\S+)\s+(\S+)\s+(\S+)$/xA', $clientName, $nameArray);
                $filtered = Arr::except($nameArray, [0]);

                $str_to_dump = sprintf('%s id: %s name: %s', $businessMailMessage, $clientID, $clientName);
                dump($str_to_dump);
                dump($filtered);
                /*
                $rolesArray = json_decode(json_encode($roles), true);
                dump($rolesArray);
                */

            }
        }
    }

}
