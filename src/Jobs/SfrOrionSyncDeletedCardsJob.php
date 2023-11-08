<?php

namespace Osfrportal\OsfrportalLaravel\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Support\Collection;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Models\SfrOrionCards;
use Illuminate\Support\Facades\Log;
use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;

class SfrOrionSyncDeletedCardsJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $orionPersonCards;
    public $pid;
    private $rfidKeysUserArray;

    /**
     * Create a new message instance.
     */
    public function __construct(string|null $pid, Collection $orionPersonCards)
    {
        $this->orionPersonCards = $orionPersonCards;
        $this->pid = $pid;
        $this->onQueue('skud');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (!is_null($this->pid)) {
            $sfrperson = SfrPerson::where('pid', $this->pid)->first();
            if (!is_null($sfrperson)) {
                Log::withContext([
                    'action' => LogActionsEnum::LOG_SYNC_SKUD(),
                    'pid' => $this->pid,
                    'fullname' => $sfrperson->getFullName(),
                ]);

                $this->rfidKeysUserArray = collect();
                $rfidKeysUser = $sfrperson->getPersonRfidCards();
                if (!is_null($rfidKeysUser)) {
                    $rfidKeysUser->each(function ($item) {
                        $this->rfidKeysUserArray->push($item->tkeydata->Code);
                    });
                }
                $diffArray = array_diff($this->rfidKeysUserArray->toArray(), $this->orionPersonCards->toArray());
                if (!empty($diffArray)) {
                    //printf("Cards diff for: %s\r\n", $sfrperson->getFullName());
                    foreach ($diffArray as $card) {
                        //printf("Card no: %s\r\n", $card);
                        $cardData = SfrOrionCards::where('tkeydata->Code', '=', $card)->first();
                        if (!is_null($cardData)) {
                            $cardData->delete();
                        }
                        Log::info('Удалена привязка карты (SoftDelete)', ['Code' => $card]);
                    }
                }
            }
        }
    }

    public function middleware()
    {
        return [(new WithoutOverlapping($this->pid))->expireAfter(180)];
    }
}