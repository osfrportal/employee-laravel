<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use danielme85\LaravelLogToDB\LogToDB;

use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;
use Osfrportal\OsfrportalLaravel\Enums\ChangelogTypesEnum;

use Osfrportal\OsfrportalLaravel\Data\SFRPhoneContactData;
use Osfrportal\OsfrportalLaravel\Models\SfrChangelog;

class SFRLogsAdminController extends Controller
{
    private $phoneLogs;
    private $systemLogs;
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
            'phone_internal' => 'Телефон (ВТС)',
            'phone_external' => 'Телефон (городской)',
            'phone_mobile' => 'Телефон (мобильный)',
            'areacode' => 'Код города',
            'vipnetapname' => 'Наименование АП VipNet Деловая почта',
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
            $tmparr = Arr::add($tmparr, 'created_at', Carbon::parse($item->created_at)->format('d.m.Y H:i:s'));
            $differences = [];
            if (empty($old)) {
                $blank_json = new SFRPhoneContactData();
                $old = $blank_json->toArray();
            }
            if (!empty($old) && !empty($new)) {
                foreach ($old as $key => $value) {
                    if ($value !== $new[$key])
                        $differences[$key] = [
                            "old" => $value,
                            "new" => $new[$key]
                        ];
                }
            }
            $tmparr = Arr::add($tmparr, 'differences', $differences);

            $this->phoneLogs->push($tmparr);

        });

        //dump($this->phoneLogs);
        return view('osfrportal::admin.logs.logsphoneupdates', ['logKeysDescription' => $logKeysDescription, 'phoneLogs' => $this->phoneLogs]);
    }

    public function changelogIndex()
    {
        //whereBetween('created_at', [now(), now()->addDays(7)])
        $logs = SfrChangelog::orderByDesc('created_at')
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->created_at)->format('d-m-Y');
            });

        //dump($logs);
        return view('osfrportal::admin.logs.changelog', ['logs' => $logs]);
    }
    public function changelogAddForm()
    {
        return view('osfrportal::admin.logs.changelogadd');
    }

    public function changelogSaveNew(Request $request)
    {
        //dd($request->all());
        $log = new SfrChangelog();
        $log->log_data = $request->input('log_data');
        $log->log_type = $request->input('log_type');
        $log->save();
        $this->flasher_interface->addSuccess('Запись добавлена');
        return redirect()->route('osfrportal.admin.logs.changelog.add');
    }
}
