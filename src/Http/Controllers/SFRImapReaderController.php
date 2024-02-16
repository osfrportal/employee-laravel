<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

//use Webklex\IMAP\Facades\Client as ImapClient;
use Webklex\PHPIMAP\Client as ImapClient;
use Webklex\PHPIMAP\ClientManager as ImapClientManager;

use Webklex\PHPIMAP\Exceptions\GetMessagesFailedException;
use Webklex\PHPIMAP\Exceptions\ConnectionFailedException;
use Carbon\CarbonImmutable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;

use Osfrportal\OsfrportalLaravel\Actions\LogAddAction;
use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;

class SFRImapReaderController extends Controller
{
    private $oClient;
    public $redis_message;

    public function __construct()
    {
        $imapClientManager = new ImapClientManager($options = []);
        $imapHost = config('osfrportal.imap_host');
        $imapPort = config('osfrportal.imap_port');
        $imapProtocol = config('osfrportal.imap_protocol');
        $imapEncryption = config('osfrportal.imap_encryption');
        $imapValidateCert = config('osfrportal.imap_validatecert');
        $imapUsername = config('osfrportal.imap_username');
        $imapPassword = config('osfrportal.imap_password');

        $this->oClient = $imapClientManager->make([
            'host' => $imapHost,
            'port' => $imapPort,
            'encryption' => $imapEncryption,
            'validate_cert' => $imapValidateCert,
            'username' => $imapUsername,
            'password' => $imapPassword,
            'protocol' => $imapProtocol
        ]);
        try {
            $this->oClient->connect();
        } catch (ConnectionFailedException $exception) {

            LogAddAction::run(LogActionsEnum::LOG_IMAP(), 'Ошибка подключения к IMAP: {msg}', ['msg' => $exception->getMessage()], 'error');
            dd($exception->getMessage());
        }
    }
    public function put1CFilesToFTP()
    {
        try {
            $oFolder = $this->oClient->getFolder('INBOX');
            LogAddAction::run(LogActionsEnum::LOG_IMAP(), 'Успешно подключились к IMAP');
        } catch (ConnectionFailedException $exception) {
            LogAddAction::run(LogActionsEnum::LOG_IMAP(), 'Ошибка подключения к IMAP: {msg}', ['msg' => $exception->getMessage()], 'error');
        }
        try {
            $aMessage = $oFolder->query()->since(now()->subDays(10))->unseen()->get();

            foreach ($aMessage as $oMessage) {
                $mailFrom = $oMessage->getFrom()[0]->mail;
                $att_date = CarbonImmutable::parse($oMessage->getDate())->format('Y-m-d');
                LogAddAction::run(LogActionsEnum::LOG_IMAP(), 'Обработка письма от {mailfrom} {att_date}', [
                    'mailfrom' => $mailFrom,
                    'att_date' => $att_date,
                ]);
                $flags = $oMessage->getFlags();
                if ($oMessage->hasAttachments()) {
                    foreach ($oMessage->getAttachments() as $oAttachment) {
                        $oAttachmentName = imap_utf8($oAttachment->getName());
                        $filename_out = Str::replaceLast('.txt', ' ' . $att_date . '.txt', $oAttachmentName);
                        $file_content = $oAttachment->getAttributes()['content'];
                        //echo $filename_out . '  (' . $oAttachment->get("size") . ')<br />';
                        if (Storage::disk('ftp1c')->missing($filename_out)) {
                            Storage::disk('ftp1c')->put($filename_out, $file_content);
                            LogAddAction::run(LogActionsEnum::LOG_IMAP(), 'IMAP: файл {filename_out} сохранен на FTP', [
                                'filename_out' => $filename_out,
                            ]);
                        } else {
                            LogAddAction::run(LogActionsEnum::LOG_IMAP(), 'IMAP: файл {filename_out} уже существует на FTP', [
                                'filename_out' => $filename_out,
                            ], 'warning');
                        }
                    }
                } else {
                    LogAddAction::run(LogActionsEnum::LOG_IMAP(), 'IMAP: письмо от {mailfrom} {att_date} не имеет вложений', [
                        'mailfrom' => $mailFrom,
                        'att_date' => $att_date,
                    ]);
                }
                $oMessage->setFlag('Seen');
            }
        } catch (GetMessagesFailedException $exception) {
            LogAddAction::run(LogActionsEnum::LOG_IMAP(), 'Ошибка получения списка писем IMAP: {msg}', [
                'msg' => $exception->getMessage(),
            ], 'error');
        }
    }
}
