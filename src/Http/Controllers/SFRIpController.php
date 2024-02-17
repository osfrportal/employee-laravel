<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;
use Illuminate\Http\Request;

class SFRIpController extends Controller
{
    public function ipIndex(Request $request) {
        return view('osfrportal::sections.ip.showip', ['myip' => $request->ip()]);
    }
}
