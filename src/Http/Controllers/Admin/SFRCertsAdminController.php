<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Collection;
use Osfrportal\OsfrportalLaravel\Models\SfrCerts;

class SFRCertsAdminController extends Controller
{
    /**
     * --------------------------------
     * API functions
     * --------------------------------
     */
    public function apiCertsListAll(Request $request)
    {
        $columnsToGet = [
            'certuuid',
            'certserial',
            'certvalidto',
            'certtype',
            'pid',
            'certdata->commonName AS CN',
            'certdata->certId AS certId',
        ];
        $allCerts = SfrCerts::with('SfrPerson')->get($columnsToGet);
        //dump($allCerts);
        return DataTables::of($allCerts)
        ->setRowClass(function ($cert) {
            if ($cert->revoked) {
                //return 'bg-warning opacity-75';
                //return 'table-warning p-2 text-dark bg-opacity-75 opacity-75';
                return 'bg-danger p-2 opacity-75';
            }
        })
        ->make(true);
    }




     /**
     * --------------------------------
     * Main functions
     * --------------------------------
     */

    public function certsShowList()
    {
        return view('osfrportal::admin.certs.certsall');
    }

}
