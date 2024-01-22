<?php
namespace Osfrportal\OsfrportalLaravel\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;

class GetPersonsBirthdaysAction
{
    use AsAction;

    private $redisKey = 'birthdays:cache';
    private $durationInSeconds = 3600;

    public function handle()
    {
        $dateFrom = Carbon::now();
        $dateTo = Carbon::now()->addDays(7);

        $personsBirthdaysCollection = collect();

        $personsFromDB = SfrPerson::BirthDayBetween($dateFrom, $dateTo)->orderBy('psurname')->get();
        foreach ($personsFromDB as $person) {
            if (!is_null($person->getAppointmentID())) {
                $personArr = [
                    'pid' => $person->getPid(),
                    'fullname' => $person->getFullName(),
                    'birthdate' => $person->getBirthDateWithoutYear(),
                    'unit' => $person->getUnit(),
                    'appointment' => $person->getAppointment(),

                ];
                $personsBirthdaysCollection->push($personArr);
            }
        }
        //$personsBirthdaysCollection = $personsBirthdaysCollection->sortBy('fullname');
        $personsBirthdaysCollection->dump();

        /*
        if (!Redis::exists($this->redisKey)) {
            $personsBirthdaysCollection = collect();
            
            $personsFromDB = SfrPerson::whereBetween('pbirthdate', [$dateFrom, $dateTo])->get();
            Redis::setex($this->redisKey, $this->durationInSeconds, json_encode($personsBirthdaysCollection));
        } else {
            Redis::expire($this->redisKey, $this->durationInSeconds);
        }

        $personsBirthdaysCollection = json_decode(Redis::get($this->redisKey));
        */
    }
}