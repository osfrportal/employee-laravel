<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Data\Crypto\SFRCryptoData;
use Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum;

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
        $parsingErrorCollection = collect();
        $notFoundCollection = collect();
        $foundCollection = collect();
        $withoutBusinessMail = collect();

        if (Storage::disk($storage)->exists($filename)) {
            $xmlString = Storage::disk($storage)->get($filename);
            $xmlData = simplexml_load_string($xmlString);
            $clients = $xmlData->xpath('//report/coordinator/client');

            foreach ($clients as $client) {
                $roles = $client->xpath('role');
                $hasBusinessMail = false;
                foreach ($roles as $role) {
                    $roleID = (string)$role->attributes()->id;
                    $roleName = (string)$role->attributes()->name;
                    if ($roleID == '0000') {
                        $hasBusinessMail = true;
                        break;
                    }
                    //$str_role_to_dump = sprintf('id: %s name: %s', $roleID, $roleName);
                    //dump($str_role_to_dump);
                }

                $clientID = (string)$client->attributes()->id;
                $clientName = Str::squish(Str::remove('058 - ', $client->attributes()->name));

                preg_match('/^(\S+)\s+(\S+)\s+(\S+)$/xA', $clientName, $nameArray);
                $filtered = Arr::except($nameArray, [0]);
                if (count($filtered) == 3 && $hasBusinessMail) {
                    $model = SfrPerson::where(['psurname'=> $filtered[1],'pname' => $filtered[2], 'pmiddlename' => $filtered[3]])->first('pid');
                    if (!is_null($model)) {
                        $pid = $model->getPid();
                    } else {
                        $pid = null;
                    }
                    if (Str::isUuid($pid)) {
                        $pushData = new SFRCryptoData(CryptoTypesEnum::VIPNET(), $clientID);
                        //$foundCollection->push(['pid' => $model->pid, 'vipnetid' => $clientID, 'vipnetname' => $clientName]);
                        $foundCollection->push($pushData);
                    } else {
                        $notFoundCollection->push(['pid' => null, 'vipnetid' => $clientID, 'vipnetname' => $clientName]);
                    }
                } else {
                    if (!$hasBusinessMail) {
                        $withoutBusinessMail->push(['pid' => null, 'vipnetid' => $clientID, 'vipnetname' => $clientName]);
                    } else {
                        $parsingErrorCollection->push(['pid' => null, 'vipnetid' => $clientID, 'vipnetname' => $clientName]);
                    }
                }

                /*
                $rolesArray = json_decode(json_encode($roles), true);
                dump($rolesArray);
                */

            }
            dump($foundCollection);
            dump($notFoundCollection);
            dump($withoutBusinessMail);
            dump($parsingErrorCollection);
        }
    }

}
