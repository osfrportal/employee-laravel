<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Osfrportal\OsfrportalLaravel\Interfaces\SFRx509Interface;

class SFRUkepController extends Controller
{
    private SFRx509Interface $interface;
    public function __construct(SFRx509Interface $interface)
    {
        $this->interface = $interface;
    }

    public function test()
    {
        dump($this->interface->getAllCertsFromStorage());
    }
}
