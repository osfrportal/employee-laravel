<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Osfrportal\OsfrportalLaravel\Actions\Crypto\CryptoListAllAction;

class SFRCryptoAdminController extends Controller
{
    public function cryptoShowList()
    {
        dump(CryptoListAllAction::run());
        return view('osfrportal::admin.crypto.cryptoall');
    }
}
