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

        return $cryptoCollection;
    }
}
