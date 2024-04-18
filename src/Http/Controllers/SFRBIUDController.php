<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Collection;

use Artisaninweb\SoapWrapper\SoapWrapper;
// https://github.com/WsdlToPhp/WsSecurity
use WsdlToPhp\WsSecurity\WsSecurity;


use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;
use Osfrportal\OsfrportalLaravel\Actions\LogAddAction;

use Osfrportal\OsfrportalLaravel\Models\SfrUser;

class SFRBIUDController extends Controller
{
    protected $soapWrapper;
    protected $buidSoapURL;
    protected $soapHeader;
    protected $usersToNotify;
    public function __construct()
    {
        parent::__construct();
        $this->soapWrapper = new SoapWrapper;
        $this->buidSoapURL = 'http://10.58.0.29:9080/ControlEJB_HTTPRouter/services/BiudAPI/wsdl/BiudAPI.wsdl';
        $this->soapHeader = WsSecurity::createWsSecuritySoapHeader('adminwf', 'rulez058', false);

        $this->soapWrapper->add('BiudAPISoapBinding', function ($service) {
            $service
                ->wsdl($this->buidSoapURL)
                ->trace(true)
                ->cache(WSDL_CACHE_NONE)
                ->customHeader($this->soapHeader);
        });
        $this->usersToNotify = SfrUser::permission('system-notifications')->get();
    }

    public function getAllOperators()
    {
        $operators = $this->soapWrapper->call('BiudAPISoapBinding.getAllOperators', []);
        //dump($operators);
        $activeUsers = collect();
        foreach ($operators->getAllOperatorsReturn as $biudOperator) {
            if ($biudOperator->blocked == 'Активен') {
                $activeUser = [
                    'fa' => $biudOperator->fa,
                    'im' => $biudOperator->im,
                    'ot' => $biudOperator->ot,
                    'login' => $biudOperator->login,
                    'blocked' => $biudOperator->blocked,
                ];
                $activeUsers->push($activeUser);
            }
        }
        $activeUsers->dump();
    }

}
