<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Osfrportal\OsfrportalLaravel\Models\SfrPersonCrypto;
use Osfrportal\OsfrportalLaravel\Data\Crypto\SFRCryptoData;
use Osfrportal\OsfrportalLaravel\Http\Requests\СryptoSaveDetailRequest;
use Osfrportal\OsfrportalLaravel\Http\Requests\СryptoAddNewRequest;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum;

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
            $this->flasher_interface->addError('Криптосредство не найдено!');
            return back();
        }
        $crypto->pid = $validated['personid'];
        $crypto->cryptodata->pid = $validated['personid'];
        $crypto->cryptodata->cryptoPurpose = $validated['cryptoPurpose'];
        $crypto->save();
        $this->flasher_interface->addSuccess('Данные успешно сохранены');
        return redirect()->route('osfrportal.admin.crypto.detail', ['cryptouuid' => $validated['cryptouuid']]);
    }

    public function addCryptoForm()
    {
        return view('osfrportal::admin.crypto.cryptonewform');
    }

    public function cryptoSaveNew(СryptoAddNewRequest $saveRequest)
    {
        $cryptoType = $saveRequest->input('cryptoType');
        if ($cryptoType->equals(CryptoTypesEnum::CRYPTOPRO())) {

            $cryptoPurpose = $saveRequest->input('cryptoPurpose', null);
            $cryptoLicenseNumber = $saveRequest->input('cryptoLicenseNumber', null);
            $personid = $saveRequest->input('personid', null);

            $crypto = SfrPersonCrypto::where('cryptotype', CryptoTypesEnum::CRYPTOPRO())->whereJsonContains('cryptodata->cryptoLicenseNumber', $cryptoLicenseNumber)->first();
            if ($crypto == null) {
                $cryptoNew = new SfrPersonCrypto();
                $cryptodata = new SFRCryptoData($cryptoType);
                $cryptodata->cryptoType = $cryptoType;
                $cryptodata->cryptoPurpose = $cryptoPurpose;
                $cryptodata->pid = $personid;
                $cryptodata->cryptoLicenseNumber = $cryptoLicenseNumber;
                $cryptoNew->pid = $personid;
                $cryptoNew->cryptotype = $cryptoType;
                $cryptoNew->cryptodata = $cryptodata;
                $cryptoNew->save();
            } else {
                $this->flasher_interface->addError('Криптосредство уже существует в базе');
                return back();
            }
        }

        $this->flasher_interface->addSuccess('Криптосредство успешно добавлено');
        return redirect()->route('osfrportal.admin.crypto.index');
    }

    public function cryptoRemovePerson($cryptouuid, $personid)
    {
        try {
            $crypto = SfrPersonCrypto::where('cryptouuid', $cryptouuid)->where('pid', $personid)->firstOrFail();

        } catch (ModelNotFoundException $e) {
            $this->flasher_interface->addError('Криптосредство с указанным работником не найдено!');
            return redirect()->route('osfrportal.admin.crypto.index');
        }
        $crypto->pid = null;
        $crypto->cryptodata->pid = null;

        $crypto->save();

        $this->flasher_interface->addSuccess('Привязка к работнику успешно удалена.');
        return redirect()->route('osfrportal.admin.crypto.detail', ['cryptouuid' => $cryptouuid]);
    }
}
