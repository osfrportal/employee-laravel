<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;
use Illuminate\Http\Request;

class SFRIpController extends Controller
{
    public function ipIndex(Request $request) {
        dump($request->ip());
        dump($request->ips());
        return view('osfrportal::sections.ip.showip');
    }
}
