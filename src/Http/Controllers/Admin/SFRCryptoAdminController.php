<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Osfrportal\OsfrportalLaravel\Models\SfrPersonCrypto;
use Osfrportal\OsfrportalLaravel\Data\Crypto\SFRCryptoData;
use Osfrportal\OsfrportalLaravel\Http\Requests\СryptoSaveDetailRequest;

use Illuminate\Database\Eloquent\ModelNotFoundException;

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

        try {
            $crypto = SfrPersonCrypto::where('cryptouuid', $validated['cryptouuid'])->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $this->flasher_interface->addError('Документ не найден!');
            return back();
        }
        $crypto->pid = $validated['personid'];
        $crypto->cryptodata->pid = $validated['personid'];
        $crypto->cryptodata->cryptoPurpose = $validated['cryptoPurpose'];
        $crypto->save();
        $this->flasher_interface->addSuccess('Данные успешно сохранены');
        return redirect()->route('osfrportal.admin.crypto.detail', ['cryptouuid' => $validated['cryptouuid']]);
    }
}
