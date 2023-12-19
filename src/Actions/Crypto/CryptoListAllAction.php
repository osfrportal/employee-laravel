<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Crypto;

use Lorisleiva\Actions\Concerns\AsAction;
use Osfrportal\OsfrportalLaravel\Models\SfrPersonCrypto;

use Yajra\DataTables\DataTables;

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
            $cryptoCollection->push($crypto->cryptodata->toArray());
        }
        return DataTables::of($cryptoCollection);
    }
}
