<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Crypto;

use Lorisleiva\Actions\Concerns\AsAction;
use Osfrportal\OsfrportalLaravel\Models\SfrPersonCrypto;
use Osfrportal\OsfrportalLaravel\Data\Crypto\SFRCryptoData;

use Yajra\DataTables\DataTables;

class CryptoListAllAction
{
    use AsAction;

    public function handle()
    {
        $cryptoCollection = collect();
        $cryptoAll = SfrPersonCrypto::all();
        foreach ($cryptoAll as $crypto) {
            $cryptoDataFull = SFRCryptoData::getFull($crypto);

            $cryptoPurpose = $crypto->cryptodata->cryptoPurpose;
            $cryptoName = $crypto->cryptodata->cryptoName;
            $cryptoUserName = $crypto->cryptodata->cryptoUserName;
            $cryptoCollection->push($cryptoDataFull->toArray());
        }
        return $cryptoCollection;
    }
}
