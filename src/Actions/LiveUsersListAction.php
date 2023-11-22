<?php
namespace Osfrportal\OsfrportalLaravel\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Redis;

use Illuminate\Support\Str;


use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Models\SfrUser;
use Osfrportal\OsfrportalLaravel\Data\SFRPersonData;

class LiveUsersListAction
{
    use AsAction;
    private function listUserIdFromRedis() {
        $collectionUserIDs = collect();
        $cursor = 0;
        $redis_prefix = config('database.redis.options.prefix');
        $pattern = $redis_prefix . 'live_users:*';
        do {
            list($cursor, $keys) = Redis::scan($cursor, 'match', $pattern);
            //dump($keys);
            foreach ($keys as $key) {
                $exploded = Str::of($key)->explode(':');
                $userUuid = $exploded[1];
                if (Str::isUuid($userUuid)) {
                    $collectionUserIDs->pull($userUuid);
                }

            }
        } while ($cursor != 0);
        dump($collectionUserIDs);
    }

    public function handle()
    {
        $this->listUserIdFromRedis();
    }

}
