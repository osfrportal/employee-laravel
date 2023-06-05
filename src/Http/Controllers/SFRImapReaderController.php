<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Webklex\IMAP\Facades\Client as ImapClient;
use Webklex\PHPIMAP\Exceptions\GetMessagesFailedException;
use Webklex\PHPIMAP\Exceptions\ConnectionFailedException;
use Carbon\CarbonImmutable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SFRImapReaderController extends Controller
{
    private $oClient;
    public function __construct() {
        $this->oClient = ImapClient::account('default');
        try {
            $this->oClient->connect();
        } catch (ConnectionFailedException $exception) {
            dd($exception->getMessage());
        }
    }
    public function getAllMessages() {
        try {
            $oFolder = $this->oClient->getFolder('INBOX');
        } catch (ConnectionFailedException $exception) {
            dd($exception->getMessage());
        }
        try {
            $aMessage = $oFolder->query()->since(now()->subDays(5))->get();

            foreach ($aMessage as $oMessage) {
                echo $oMessage->getFrom()[0]->mail . '<br />';
                $att_date = CarbonImmutable::parse($oMessage->getDate())->format('Y-m-d');
                echo $att_date . '<br />';
                if ($oMessage->hasAttachments()) {
                    Storage::disk('local')->makeDirectory('files1c');
                    $save_path = storage_path('app/files1c');
                    foreach ($oMessage->getAttachments() as $oAttachment) {
                        $oAttachmentName = $oAttachment->getName();
                        $filename_out = Str::replaceLast('.txt', ' ' . $att_date . '.txt', $oAttachmentName);
                        echo $filename_out . '<br />';
                        echo $oAttachment->get("size") . '<br />';
                        $oAttachment->save($save_path, $filename_out);
                        echo '!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!<br>';
                    }
                }
                echo '-----------------------<br>';
            }
            
           
            echo '<hr>';
        } catch (GetMessagesFailedException $exception) {
            dd($exception->getMessage());
        }
    }



}
