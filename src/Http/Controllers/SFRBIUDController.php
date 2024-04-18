<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Carbon\Carbon;
use Artisaninweb\SoapWrapper\SoapWrapper;

use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;
use Osfrportal\OsfrportalLaravel\Actions\LogAddAction;

use Osfrportal\OsfrportalLaravel\Models\SfrUser;

class SFRBIUDController extends Controller
{
    protected $soapWrapper;
    protected $buidSoapURL;

    protected $usersToNotify;
    public function __construct()
    {
        parent::__construct();
        $this->soapWrapper = new SoapWrapper;
        $this->buidSoapURL = 'http://10.58.0.29:9080/ControlEJB_HTTPRouter/services/BiudAPI/wsdl/BiudAPI.wsdl';
        $this->soapWrapper->add('BiudAPISoapBinding', function ($service) {
            $service
                ->wsdl($this->buidSoapURL)
                ->trace(true)
                ->cache(WSDL_CACHE_NONE)
                ->options([
                    'Username' => 'adminwf',
                    'Password' => 'rulez058',
                ]);
        });
        $this->usersToNotify = SfrUser::permission('system-notifications')->get();
    }

    public function getAllOperators()
    {
        $operators = $this->soapWrapper->call('BiudAPISoapBinding.getAllOperators', []);
        dump($operators);
    }

}
