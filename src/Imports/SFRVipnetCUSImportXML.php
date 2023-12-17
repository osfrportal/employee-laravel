<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Models\SfrPersonCrypto;
use Osfrportal\OsfrportalLaravel\Data\Crypto\SFRCryptoData;
use Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum;

class SFRVipnetCUSImportXML
{
    public function import($filename, $storage)
    {
        $parsingErrorCollection = collect();
        $notFoundCollection = collect();
        $foundCollection = collect();
        $withoutBusinessMail = collect();
        $alreadyCreated = collect();

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
                $clientName = $client->attributes()->name;

                $cryptoModel = SfrPersonCrypto::firstOrNew(['cryptotype' => CryptoTypesEnum::VIPNET(), 'cryptoapid' => $clientID]);


                if ($cryptoModel->exists) {
                    $alreadyCreated->push($pushData);
                } else {
                    $pushData = new SFRCryptoData(CryptoTypesEnum::VIPNET(), $clientID, $clientName);
                    $cryptoModel->cryptodata = $pushData;
                    $clientNameForFind = Str::squish(Str::remove('058 - ', $clientName));
                    preg_match('/^(\S+)\s+(\S+)\s+(\S+)$/xA', $clientNameForFind, $nameArray);
                    $filtered = Arr::except($nameArray, [0]);

                    if ($hasBusinessMail) {
                        if (count($filtered) == 3) {
                            $model = SfrPerson::where(['psurname' => $filtered[1], 'pname' => $filtered[2], 'pmiddlename' => $filtered[3]])->first('pid');
                            if (!is_null($model)) {
                                $pid = $model->getPid();
                            } else {
                                $pid = null;
                            }
                            $cryptoModel->pid = $pid;

                            if (Str::isUuid($pid)) {
                                $foundCollection->push($pushData);
                            } else {
                                $notFoundCollection->push($pushData);
                            }
                        } else {
                            $parsingErrorCollection->push($pushData);
                        }


                    } else {
                        $withoutBusinessMail->push($pushData);
                    }
                }
                $cryptoModel->save();
                /*
                $rolesArray = json_decode(json_encode($roles), true);
                dump($rolesArray);
                */

            }
            dump($foundCollection);
            dump($alreadyCreated);
            dump($notFoundCollection);
            dump($withoutBusinessMail);
            dump($parsingErrorCollection);
        }
    }

}
