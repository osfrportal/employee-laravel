<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

//use Webklex\IMAP\Facades\Client as ImapClient;
use Webklex\PHPIMAP\Client as ImapClient;
use Webklex\PHPIMAP\ClientManager as ImapClientManager;

use Webklex\PHPIMAP\Exceptions\GetMessagesFailedException;
use Webklex\PHPIMAP\Exceptions\ConnectionFailedException;
use Carbon\CarbonImmutable;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;

use Osfrportal\OsfrportalLaravel\Actions\LogAddAction;
use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;
use Osfrportal\OsfrportalLaravel\Data\SFRImapStatusData;

class SFRImapReaderController extends Controller
{
    private $oClient;
    private $redisImapMessage;

    private $redisImapKey = 'mainterance:imap';

    private $tryAgain = true;

    public function __construct()
    {
        $redisImapMessageBlank = ['error' => false, 'message' => '', 'tryAgain' => true, 'canRunImports' => false];

        if (Redis::exists($this->redisImapKey)) {
            $dateToday = Carbon::now();

            $keyData = json_decode(Redis::get($this->redisImapKey));
            $dateFromRedis = Carbon::parse($keyData->date);
            dump($dateFromRedis->isCurrentDay());
            dump($dateToday->isSameDay($dateFromRedis));
            if ($dateToday->isSameDay($dateFromRedis)) {
                if (!$keyData->tryAgain) {
                    exit(0);
                } else {
                    $this->redisImapMessage = ['error' => $keyData->error, 'message' => $keyData->message, 'tryAgain' => $keyData->tryAgain, 'canRunImports' => $keyData->canRunImports];
                    $this->tryAgain = $keyData->tryAgain;
                }
            } else {
                $this->redisImapMessage = $redisImapMessageBlank;
                $this->tryAgain = true;
            }

        } else {
            $this->redisImapMessage = $redisImapMessageBlank;
            $this->tryAgain = true;
        }

        Redis::set($this->redisImapKey, SFRImapStatusData::from($this->redisImapMessage)->toJson());

        if ($this->tryAgain) {
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
                Arr::set($this->redisImapMessage, 'error', true);
                Arr::set($this->redisImapMessage, 'message', sprintf('Ошибка подключения к IMAP: %s', $exception->getMessage()));
                Arr::set($this->redisImapMessage, 'tryAgain', true);
                Redis::set($this->redisImapKey, SFRImapStatusData::from($this->redisImapMessage)->toJson());

                LogAddAction::run(LogActionsEnum::LOG_IMAP(), 'Ошибка подключения к IMAP: {msg}', ['msg' => $exception->getMessage()], 'error');
                dd($exception->getMessage());
            }
        }
    }
    public function put1CFilesToFTP()
    {
        if ($this->tryAgain) {
            try {
                $oFolder = $this->oClient->getFolder('INBOX');
                Arr::set($this->redisImapMessage, 'error', false);
                Arr::set($this->redisImapMessage, 'message', 'Успешно подключились к IMAP');
                Arr::set($this->redisImapMessage, 'tryAgain', false);
                Redis::set($this->redisImapKey, SFRImapStatusData::from($this->redisImapMessage)->toJson());

                LogAddAction::run(LogActionsEnum::LOG_IMAP(), 'Успешно подключились к IMAP');
            } catch (ConnectionFailedException $exception) {
                Arr::set($this->redisImapMessage, 'error', true);
                Arr::set($this->redisImapMessage, 'message', sprintf('Ошибка подключения к IMAP: %s', $exception->getMessage()));
                Arr::set($this->redisImapMessage, 'tryAgain', true);

                Redis::set($this->redisImapKey, SFRImapStatusData::from($this->redisImapMessage)->toJson());

                LogAddAction::run(LogActionsEnum::LOG_IMAP(), 'Ошибка подключения к IMAP: {msg}', ['msg' => $exception->getMessage()], 'error');
            }
            try {
                $aMessage = $oFolder->query()->since(now()->subDays(10))->unseen()->get();
                $msgCount = 0;
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
                        $msgCount++;
                    } else {
                        LogAddAction::run(LogActionsEnum::LOG_IMAP(), 'IMAP: письмо от {mailfrom} {att_date} не имеет вложений', [
                            'mailfrom' => $mailFrom,
                            'att_date' => $att_date,
                        ]);
                    }
                    Arr::set($this->redisImapMessage, 'error', false);
                    Arr::set($this->redisImapMessage, 'message', sprintf('Письмо от %s (%s) успешно обработано', $mailFrom, $att_date));
                    Arr::set($this->redisImapMessage, 'tryAgain', false);

                    Redis::set($this->redisImapKey, SFRImapStatusData::from($this->redisImapMessage)->toJson());

                    $oMessage->setFlag('Seen');
                }
                if ($msgCount > 0) {
                    Arr::set($this->redisImapMessage, 'error', false);
                    Arr::set($this->redisImapMessage, 'message', 'Получение писем IMAP успешно завершено');
                    Arr::set($this->redisImapMessage, 'tryAgain', false);
                    Arr::set($this->redisImapMessage, 'canRunImports', true);
                    Redis::set($this->redisImapKey, SFRImapStatusData::from($this->redisImapMessage)->toJson());
                } else {
                    Arr::set($this->redisImapMessage, 'error', true);
                    Arr::set($this->redisImapMessage, 'message', 'Отсуствуют письма подходящие для обработки');
                    Arr::set($this->redisImapMessage, 'tryAgain', true);

                    Redis::set($this->redisImapKey, SFRImapStatusData::from($this->redisImapMessage)->toJson());
                }
            } catch (GetMessagesFailedException $exception) {
                Arr::set($this->redisImapMessage, 'error', true);
                Arr::set($this->redisImapMessage, 'message', sprintf('Ошибка получения списка писем IMAP: %s', $exception->getMessage()));
                Arr::set($this->redisImapMessage, 'tryAgain', true);

                Redis::set($this->redisImapKey, SFRImapStatusData::from($this->redisImapMessage)->toJson());

                LogAddAction::run(LogActionsEnum::LOG_IMAP(), 'Ошибка получения списка писем IMAP: {msg}', [
                    'msg' => $exception->getMessage(),
                ], 'error');
            }
        }
    }
}
