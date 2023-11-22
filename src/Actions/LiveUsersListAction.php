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

    public function handle()
    {
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
                    dump($userUuid);
                }

            }
        } while ($cursor != 0);

    }

}
