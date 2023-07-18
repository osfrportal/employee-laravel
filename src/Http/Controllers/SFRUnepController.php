<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Osfrportal\OsfrportalLaravel\Interfaces\SFRx509Interface;
use Osfrportal\OsfrportalLaravel\Services\SFRx509UnepService;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum;

class SFRUnepController extends Controller
{
    //private SFRx509Interface $interface;
    public function __construct(private SFRx509Interface $interface)
    {
        $this->interface = $interface;
    }
    private function searchPidBySnils(string $snils)
    {
        $person = SfrPerson::where('psnils', $snils)->firstOr(['pid'], function () {
            $person['pid'] = null;
            return $person;
        });
        return $person['pid'];
    }

    public function test()
    {
        //$this->signXMLUnep();
        $this->getAllCertsToDB();
        dump('done');
    }


    public function getAllCertsToDB()
    {

        $allCertsCollection = $this->interface->getAllCertsFromStorage();
        $allCertsCollection->each(function ($item) {
            $certDTO = $this->interface->parceCertToDTO($item);
            $pid = $this->searchPidBySnils($certDTO->Snils);
            //dump($person, $certDTO->Snils);
            $this->interface->saveCertToDB($certDTO, $pid);
        });
        //TODO: добавить логгирование

    }

    public function signXMLUnep()
    {
        $sxe = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" standalone="no" ?><Envelope xmlns="urn:envelope"></Envelope>');
        $xml_body = $sxe->addChild('Body');
        $xml_data = $xml_body->addChild('Data');
        $xml_data->addAttribute('xml:id', 'dataToSign');
        $xml_data->addChild('portalUser', Auth::user()->username);
        $xml_data->addChild('portalPersonUUID', Auth::user()->pid);
        $xml_data->addChild('docSignName', 'Mr. Parser');
        $xml_data->addChild('docSignFileUUID', 'Mr. Parser');
        $xml_data->addChild('docSignHashGOST', 'Mr. Parser');
        $xml_data->addChild('docSignTimestamp', 'Mr. Parser');
        $xmlToSign = $sxe->asXML();
        $xmlToSign = strtr($xmlToSign, array("\n" => ''));
        $this->interface->signXML($xmlToSign, CertsTypesEnum::UNEP(), 202667);
    }
}
