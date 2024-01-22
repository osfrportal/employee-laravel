<?php
namespace Osfrportal\OsfrportalLaravel\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;

class GetPersonsBirthdaysAction
{
    use AsAction;

    private $redisKey = 'birthdays:cache';
    private $durationInSeconds = 3600;

    public function handle()
    {
        $personsFromDB = SfrPerson::whereBetween('pbirthdate', [$dateFrom, $dateTo])->get();
        dump($personsFromDB);
        /*
        if (!Redis::exists($this->redisKey)) {
            $personsBirthdaysCollection = collect();
            $dateFrom = Carbon::now();
            $dateTo = Carbon::now()->subDays(7);
            $personsFromDB = SfrPerson::whereBetween('pbirthdate', [$dateFrom, $dateTo])->get();
            Redis::setex($this->redisKey, $this->durationInSeconds, json_encode($personsBirthdaysCollection));
        } else {
            Redis::expire($this->redisKey, $this->durationInSeconds);
        }

        $personsBirthdaysCollection = json_decode(Redis::get($this->redisKey));
        */
    }
}