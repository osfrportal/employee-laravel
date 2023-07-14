<?php

namespace Osfrportal\OsfrportalLaravel\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Osfrportal\OsfrportalLaravel\Interfaces\SFRx509Interface;
use Illuminate\Support\Arr;
use GuzzleHttp\Client;
use Ramsey\Uuid\Uuid;
use Osfrportal\OsfrportalLaravel\Data\SFRCertData;

use Osfrportal\OsfrportalLaravel\Models\SfrCerts;
use Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum;
use Illuminate\Support\Facades\Log;

class SFRx509UnepService implements SFRx509Interface
{
    private $unep_cookieJar;
    private $pki_client;
    private $pki_token;
    private $pki_user_data;
    private $pki_options;
    private $hsmApiUrl;
    private $collection_certs;

    public function __construct()
    {
        $this->hsmApiUrl = config('osfrportal.hsm_apiurl');
        $this->unep_cookieJar = new \GuzzleHttp\Cookie\CookieJar;
        $this->pki_options = [
            'base_uri' => $this->hsmApiUrl,
            'timeout'  => 0,
            'debug' => false,
            'cookies' => $this->unep_cookieJar,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.3726.145 Safari/537.36 YaBrowser/129.0.3726.145',
                'Accept' => 'application/json',
            ],
        ];



        $this->pki_client = new Client($this->pki_options);
    }


    public function __destruct()
    {
        $this->hsmLogout();
    }

    private function hsmLogin()
    {
        $hsmLogin = config('osfrportal.hsm_login');
        $hsmPassword = config('osfrportal.hsm_password');

        $response = $this->pki_client->request('POST', 'login', [
            'json' => [
                'login' => $hsmLogin,
                'password' => $hsmPassword,
            ],
        ]);
        //TODO: добавить проверку на корректный вход.
        $this->pki_user_data = json_decode($response->getBody(), flags: JSON_OBJECT_AS_ARRAY);
        Log::info('UNEP: вход пользователя', [
            'response' => $this->pki_user_data,
        ]);
        $this->pki_token = $this->unep_cookieJar->getCookieByName('XSRF-TOKEN')->getValue();
    }

    private function hsmLogout()
    {
        $response = $this->pki_client->request('POST', 'logout', [
            'headers' => [
                'X-XSRF-TOKEN' => $this->pki_token,
            ],
            'json' => [
                'id' => $this->pki_user_data['id'],
            ],
        ]);
        Log::info('UNEP: выход пользователя', [
            'response' => json_decode($response->getBody(), flags: JSON_OBJECT_AS_ARRAY),
        ]);
        //dump(json_decode($response->getBody(), flags: JSON_OBJECT_AS_ARRAY));
    }

    private function hsmGetPaged(int $pagenum = 0): array
    {
        $response_all_certs = $this->pki_client->request('GET', 'cert', [
            'headers' => [
                'X-XSRF-TOKEN' => $this->pki_token,
            ],
            'query' => [
                'Page' => $pagenum,
                'per_page' => 100,
                'sort' => 'not_after',
                'order' => 'asc',
            ]
        ]);
        return json_decode($response_all_certs->getBody(), flags: JSON_OBJECT_AS_ARRAY);
    }
    public function getAllCertsFromStorage(): Collection
    {
        $this->hsmLogin();
        $this->collection_certs = collect();
        $merged_array = array();
        $pagenum = 0;

        do {
            $response_all_certs_json = $this->hsmGetPaged($pagenum);
            $merged_array = array_merge($merged_array, $response_all_certs_json['data']);
            $pagenum++;
        } while (count($response_all_certs_json['data']) > 0);

        Arr::map($merged_array, function (array $value) {

            $tmp_arr = array();
            $tmp_arr['cert_id'] = $value['id'];

            $tmp_arr['not_before'] = $value['not_before'];
            $tmp_arr['not_after'] = $value['not_after'];

            $tmp_arr['ser_num'] = $value['ser_num'];
            $tmp_arr['key_type'] = $value['key_type'];
            $tmp_arr['INN'] = $value['INN'];
            $tmp_arr['SNILS'] = $value['SNILS'];
            $tmp_arr['E_mail'] = $value['E_mail'];
            $tmp_arr['countryName'] = $value['countryName'];
            $tmp_arr['stateOrProvinceName'] = $value['stateOrProvinceName'];
            $tmp_arr['organizationName'] = $value['organizationName'];
            $tmp_arr['givenName'] = $value['givenName'];
            $tmp_arr['surname'] = $value['surname'];
            $tmp_arr['commonName'] = $value['commonName'];

            $tmp_arr['iss_INN'] = $value['iss_INN'];
            $tmp_arr['iss_OGRN'] = $value['iss_OGRN'];
            $tmp_arr['iss_E_mail'] = $value['iss_E_mail'];
            $tmp_arr['iss_countryName'] = $value['iss_countryName'];
            $tmp_arr['iss_stateOrProvinceName'] = $value['iss_stateOrProvinceName'];
            $tmp_arr['iss_organizationName'] = $value['iss_organizationName'];
            $tmp_arr['iss_streetAddress'] = $value['iss_streetAddress'];
            $tmp_arr['iss_localityName'] = $value['iss_localityName'];
            $tmp_arr['iss_commonName'] = $value['iss_commonName'];

            $this->collection_certs->push($tmp_arr);
        });

        $this->hsmLogout();
        return $this->collection_certs;
    }
    public function parceCertToDTO(array $certdata)
    {
        return SFRCertData::from($certdata);
    }
    public function saveCertToDB(SFRCertData $certdata, string|null $pid)
    {
        $to_db = SfrCerts::updateOrCreate(
            [
                'certserial' => $certdata->serialNumber,
            ],
            [
                'certvalidfrom' => $certdata->notBefore,
                'certvalidto' => $certdata->notAfter,
                'certdata' => $certdata,
                'certtype' => CertsTypesEnum::UNEP(),
                'pid' => $pid,
            ]
        );
        Log::info('UNEP: сертификат сохранен в базе', [
            'certserial' => $certdata->serialNumber,
            'certvalidfrom' => $certdata->notBefore,
            'certvalidto' => $certdata->notAfter,
            'certtype' => CertsTypesEnum::UNEP(),
            'pid' => $pid,
        ]);
        return;
    }
    public function signXML(string $signdata, CertsTypesEnum $certtype, int|null $certid)
    {
        $this->hsmLogin();
        $postdata = ['id_cert' => $certid, 'sign_type' => 0];
        $response2 = Http::withOptions($this->pki_options)
            ->withHeaders(['X-XSRF-TOKEN' => $this->pki_token])
            ->attach('file', $signdata)
            ->post('xml_sign', ['data' => json_encode($postdata)]);
        $signed_xml = $response2->body();
        dump($signed_xml);
        dump('-------------------------------');
        $this->checkSignXML($signed_xml);
        $this->hsmLogout();
        return;
    }

    private function checkSignXML(string $signedData)
    {
        $this->hsmLogin();

        $response3 = Http::withOptions($this->pki_options)
            ->withHeaders(['X-XSRF-TOKEN' => $this->pki_token])
            ->attach('file', $signedData)
            ->post('verify_info');
        $json_resp = $response3->json();
        $cert = Arr::get($json_resp, '0.cert');
        dump($json_resp);
    }
}
