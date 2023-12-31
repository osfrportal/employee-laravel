<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Osfrportal\OsfrportalLaravel\Models\SfrPersonCrypto;
use Osfrportal\OsfrportalLaravel\Data\Crypto\SFRCryptoData;
use Osfrportal\OsfrportalLaravel\Http\Requests\СryptoSaveDetailRequest;

use Illuminate\Http\Request;

class SFRCryptoAdminController extends Controller
{
    public function cryptoShowList()
    {
        return view('osfrportal::admin.crypto.cryptoall');
    }

    public function showDetailedInfo(string $cryptouuid)
    {
        $crypto = SfrPersonCrypto::where('cryptouuid', $cryptouuid)->first();
        $cryptoDataFull = SFRCryptoData::getFull($crypto);
        return view('osfrportal::admin.crypto.cryptodetail', ['cryptoDataFull' => $cryptoDataFull]);
    }

    public function cryptoSaveDetail(СryptoSaveDetailRequest $saveRequest)
    {
        $validated = $saveRequest->validated();
        $crypto = SfrPersonCrypto::where('cryptouuid', $validated['cryptouuid'])->first();
        $crypto->pid = $validated['personid'];
        //$crypto->save();
        dump($crypto);
        dd($validated);
    }
}
