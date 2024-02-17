<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;
use Illuminate\Http\Request;
use Osfrportal\OsfrportalLaravel\Models\SfrIpDomainLogin;

class SFRIpController extends Controller
{

    public function storeDataFromPC(Request $request) {
        $validatedData = $request->validate([
            'ipadr' => 'required|ip',
            'domainlogin' => 'required|string|max:25',
        ]);
        $domainlogin = strtolower($validatedData['domainlogin']);
        $ipadr = $validatedData['ipadr'];

        $ipdomainmodel = new SfrIpDomainLogin;
        $ipdomainmodel->ipaddr = $ipadr;
        $ipdomainmodel->domainlogin = $domainlogin;
        $ipdomainmodel->save();


    }
    public function ipIndex(Request $request) {
        return view('osfrportal::sections.ip.showip', ['myip' => $request->ip()]);
    }
}
