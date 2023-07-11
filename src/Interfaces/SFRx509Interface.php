<?php

namespace Osfrportal\OsfrportalLaravel\Interfaces;

use Illuminate\Support\Collection;
use Osfrportal\OsfrportalLaravel\Data\SFRCertData;
use Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum;

interface SFRx509Interface
{


    /**
     * Получение списка сертификатов из хранилища
     * @return \Illuminate\Support\Collection
     */
    public function getAllCertsFromStorage(): Collection;

    /**
     * Разбор сертификата и передача его значений в DTO структуру
     * @param array $certdata
     * @return SFRCertData
     */
    public function parceCertToDTO(array $certdata);

    /**
     * Сохранение данных сертификата в базу
     * @param SFRCertData $certdata
     * @param string|null $pid
     * @return void
     */
    public function saveCertToDB(SFRCertData $certdata, string|null $pid);

    /**
     * Подписание XML файла
     * @param string $signdata
     * @param CertsTypesEnum $certtype
     * @param int|null $certid
     * @return void
     */
    public function signXML(string $signdata, CertsTypesEnum $certtype, int|null $certid);
}
