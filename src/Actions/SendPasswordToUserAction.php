<?php
namespace Osfrportal\OsfrportalLaravel\Actions;

use Illuminate\Support\Str;

use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Decorators\JobDecorator;

use Osfrportal\OsfrportalLaravel\Mail\SendPassword;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Data\SFRPersonData;
use Osfrportal\OsfrportalLaravel\Data\SFRPhoneContactData;
use Osfrportal\OsfrportalLaravel\Actions\GeneratePersonLoginPassAction;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Mailer\Exception\TransportException;

class SendPasswordToUserAction
{
    use AsAction;

    public function handle(SfrPerson $sfrperson)
    {
        $randPasword = Str::password(10);
        $SFRPersonData = SFRPersonData::from($sfrperson);
        $SFRPhoneContactData = SFRPhoneContactData::from($sfrperson);
        $personLogin = GeneratePersonLoginPassAction::run($sfrperson, $randPasword);
        $jobData = [
            'userlogin' => $personLogin,
            'newpassword' => $randPasword,
            'useremail' => $SFRPhoneContactData->email_ext,
            'userfullname' => $SFRPersonData->persondata_fullname,
        ];
        $mailMessage = new SendPassword($jobData['userfullname'], $jobData['userlogin'], $jobData['newpassword']);
        Log::info('Отправка письма', ['jobData' => $jobData]);
        try {
            Mail::to($jobData['useremail'])->send($mailMessage);
        } catch (TransportException $e) {
            //Log::error('ОШИБКА отправки письма', ['EMessage' => $e->getMessage(),'EDebugMessage' => $e->getDebug(),]);
            Log::error('ОШИБКА отправки письма', ['EMessage' => $e->getMessage(),]);
        }

    }

    public function configureJob(JobDecorator $job): void
    {
        $job->onQueue('emails');
    }

    public function asJob(SfrPerson $sfrperson): void
    {
        $this->handle($sfrperson);
    }
}
