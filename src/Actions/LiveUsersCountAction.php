<?php
namespace Osfrportal\OsfrportalLaravel\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Redis;

class LiveUsersCountAction
{
    use AsAction;

    public function handle()
    {
        $count = 0;
        $cursor = null;
        $redis_prefix = config('database.redis.options.prefix');
        $pattern = $redis_prefix . 'live_users:*';
        do {
            list($cursor, $keys) = Redis::scan($cursor, 'match', $pattern);
            $count += count($keys ?? []);
        } while ($cursor != 0);

        return $count;
    }

}
