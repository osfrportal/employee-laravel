<?php
namespace Osfrportal\OsfrportalLaravel\Actions;

use Lorisleiva\Actions\Concerns\AsAction;

use Illuminate\Support\Facades\Log;
use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;

class LogAddAction
{
    use AsAction;

    public function handle(LogActionsEnum $logActionType, string $logMessage, array $logContext = [])
    {
        Log::withContext([
            'action' => $logActionType,
        ]);
        Log::info($logMessage, $logContext);
    }
}
