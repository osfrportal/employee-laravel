<?php
namespace Osfrportal\OsfrportalLaravel\Actions;

use Lorisleiva\Actions\Concerns\AsAction;

use Illuminate\Support\Facades\Log;
use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;

class LogAddAction
{
    use AsAction;

    public function handle(LogActionsEnum $logActionType, string $logMessage, array $logContext = [], string $logType = 'info')
    {
        Log::withContext([
            'action' => $logActionType,
        ]);
        switch ($logType) {
            case 'info':
                Log::info($logMessage, $logContext);
                break;
            case 'warning':
                Log::warning($logMessage, $logContext);
                break;
            case 'error':
                Log::error($logMessage, $logContext);
                break;

            default:
                Log::info($logMessage, $logContext);
                break;
        }
        
    }
}
