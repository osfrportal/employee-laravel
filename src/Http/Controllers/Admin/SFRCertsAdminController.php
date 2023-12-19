<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Collection;
use Osfrportal\OsfrportalLaravel\Models\SfrCerts;
use Illuminate\Support\Facades\Redis;

class SFRCertsAdminController extends Controller
{
    private $redisKeyCertsList = 'admin:certs:cache:listall';
    private $durationInSeconds = 3600;
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
        if (!Redis::exists($this->redisKeyCertsList)) {
            $allCertsFromDB = SfrCerts::with('SfrPerson')->get($columnsToGet);
            Redis::setex($this->redisKeyCertsList, $this->durationInSeconds, json_encode($allCertsFromDB));            
        }

        $allCerts = json_decode(Redis::get($this->redisKeyCertsList));

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
