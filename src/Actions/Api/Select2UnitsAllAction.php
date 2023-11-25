<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Api;

use Lorisleiva\Actions\Concerns\AsAction;

use Osfrportal\OsfrportalLaravel\Models\SfrUnits;
use Osfrportal\OsfrportalLaravel\Http\Resources\Select2UnitsAllCollection;


class Select2UnitsAllAction
{
    use AsAction;

    public function handle()
    {
        dump(SfrUnits::all());
        //return new Select2UnitsAllCollection(SfrUnits::all());
    }

}
