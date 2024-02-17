<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

class SFRIpController extends Controller
{
    public function ipIndex() {
        return view('osfrportal::sections.ip.showip');
    }
}