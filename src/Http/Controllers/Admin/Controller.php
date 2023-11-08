<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Osfrportal\OsfrportalLaravel\Models\SfrUser;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public $flasher_interface;

    protected $usersToNotify;

    public function __construct()
    {
        set_time_limit(0);
        $this->flasher_interface = flash()
            ->options([
                'timeout' => '10000',
                'layout' => 'topCenter',
                'modal' => true,
                'closeWith' => ['click', 'button'],
                'theme' => 'bootstrap-v5'
            ]);
        if (!app()->runningInConsole()) {
            $this->usersToNotify = SfrUser::permission('system-notifications')->get();
        }
    }
}