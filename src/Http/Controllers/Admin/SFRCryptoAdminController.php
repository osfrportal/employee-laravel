<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

class SFRCryptoAdminController extends Controller
{
    public function cryptoShowList()
    {
        return view('osfrportal::admin.crypto.cryptoall');
    }

    public function showDetailedInfo(string $cryptouuid)
    {
        return view('osfrportal::admin.crypto.cryptodetail');
    }
}
