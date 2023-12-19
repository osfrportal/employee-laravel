<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Crypto;

use Lorisleiva\Actions\Concerns\AsAction;
use Osfrportal\OsfrportalLaravel\Models\SfrPersonCrypto;

class CryptoListAllAction
{
    use AsAction;

    public function handle()
    {
        $cryptoCollection = collect();
        $cryptoAll = SfrPersonCrypto::all();
        foreach ($cryptoAll as $crypto) {
            $cryptoPurpose = $crypto->cryptodata->cryptoPurpose;
            $cryptoName = $crypto->cryptodata->cryptoName;
            $cryptoUserName = $crypto->cryptodata->cryptoUserName;
            $cryptoCollection->push($crypto->cryptodata);
        }
        return $cryptoCollection;
    }
}
