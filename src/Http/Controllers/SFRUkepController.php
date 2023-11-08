<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Osfrportal\OsfrportalLaravel\Interfaces\SFRx509Interface;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum;


class SFRUkepController extends Controller
{
    private SFRx509Interface $interface;
    public function __construct(SFRx509Interface $interface)
    {
        $this->interface = $interface;
    }

    private function searchPidBySnils(string|null $snils)
    {
        if (!is_null($snils)) {
            $person = SfrPerson::where('psnils', $snils)->firstOr(['pid'], function () {
                $person['pid'] = null;
                return $person;
            });
        } else {
            $person['pid'] = null;
        }
        return $person['pid'];
    }

    public function getAllCertsToDB()
    {

        $allCertsCollection = $this->interface->getAllCertsFromStorage();
        //dump($allCertsCollection);
        $allCertsCollection->each(function ($item) {
            $certDTO = $this->interface->parceCertToDTO($item);
            $pid = $this->searchPidBySnils($certDTO->Snils);
            $this->interface->saveCertToDB($certDTO, $pid);
        });
        //TODO: добавить логгирование
    }
}