<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public $flasher_interface;

    public function __construct()
    {
        $this->flasher_interface = flash()
            ->options([
                'timeout' => '10000',
                'layout' => 'topCenter',
                'modal' => true,
                'closeWith' => ['click', 'button'],
                'theme' => 'bootstrap-v5'
            ]);
    }
}
