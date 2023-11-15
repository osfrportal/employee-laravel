<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use danielme85\LaravelLogToDB\LogToDB;
use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;

class SFRLogsAdminController extends Controller
{
    private $phoneLogs;
    /**
     * ----------------------------
     * API функции
     * ----------------------------
     */


    /**
     * ----------------------------
     * Основные функции
     * ----------------------------
     */
    public function logsPhoneUpdates(Request $request)
    {
        $logKeysDescription = [
            'room' => 'Кабинет',
            'address' => 'Адрес (почтовый)',
            'email_ext' => 'Адрес (электронный)',
            'phone_external' => 'Телефон (ВТС)',
            'phone_internal' => 'Телефон (городской)',
            'phone_mobile' => 'Телефон (мобильный)',
            'areacode' => 'Код города',
        ];

        $this->phoneLogs = collect();
        $days_count = 30;
        $phone_update_logs = LogToDB::model(null, 'pgsql', 'sfrlogs')->orderByDesc('created_at')->whereJsonContains('context->action', LogActionsEnum::LOG_PHONE_UPDATE())->whereDate('created_at', '>=', Carbon::now()->subDays($days_count))->get();
        $phone_update_logs->each(function ($item) {
            $tmparr = [];
           $tmparr = Arr::add($tmparr, 'message', $item->message);
           $tmparr = Arr::add($tmparr, 'personFullName', $item->context['personFullName']);
           $tmparr = Arr::add($tmparr, 'personPid', $item->context['personPid']);
           $new = json_decode($item->context['contactdata_new'], true);
           $old = json_decode($item->context['contactdata_old'], true);
           $tmparr = Arr::add($tmparr, 'sfrperson_username', $item->extra['sfrperson_username']);
           $tmparr = Arr::add($tmparr, 'sfrperson_pid', $item->extra['sfrperson_pid']);
           $tmparr = Arr::add($tmparr, 'sfrperson_fio', $item->extra['sfrperson_fio']);
           $tmparr = Arr::add($tmparr, 'created_at', $item->created_at);
           $differences = [];
           foreach ($old as $key => $value) {
            if ($value !== $new[$key])
                $differences[$key] = [
                    "old" => $value,
                    "new" => $new[$key]
                ];
            }

            $tmparr = Arr::add($tmparr, 'differences', $differences);

            $this->phoneLogs->push($tmparr);

        });

        //dump($this->phoneLogs);
        return view('osfrportal::admin.logs.logsphoneupdates', ['logKeysDescription' => $logKeysDescription, 'phoneLogs' => $this->phoneLogs]);
    }
}
