<?php

namespace Osfrportal\OsfrportalLaravel\Livewire\Admin;

use Livewire\Component;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use Osfrportal\OsfrportalLaravel\Data\SFRImapStatusData;
use Osfrportal\OsfrportalLaravel\Data\SFRRcaImportStatusData;

class RedisSubscribeMainterance extends Component
{
    public $durationInSeconds;

    public function __construct()
    {
        $this->durationInSeconds = 35;
    }
    public function render()
    {
        $keyImap = 'mainterance:imap';
        $keyRCA = 'mainterance:rcaimport';

        //$userId = Auth::user()->userid;
        //$key = "admin:mainterance:{$userId}";

        //$msg = json_encode(array('time' => 'time_message', 'message' => 'text_message'));
        //Redis::setex($key, $this->durationInSeconds, $msg);
        //Redis::set($key, $msg, 'EX', 35);
        $redisImapData = SFRImapStatusData::from(Redis::get($keyImap));
        $redisRCAData = SFRRcaImportStatusData::from(Redis::get($keyRCA));
        return view('osfrportal::livewire.admin.mainterance-messages', ['imapMessage' => $redisImapData, 'rcaMessage' => $redisRCAData]);
    }
}
