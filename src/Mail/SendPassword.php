<?php

namespace Osfrportal\OsfrportalLaravel\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Osfrportal\OsfrportalLaravel\Data\SFRPersonData;

class SendPassword extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(protected string $userfullname, protected string $userlogin, protected string $newpassword)
    {

    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Учетные данные для входа на портал',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'osfrportal::mail.sendpassword',
            with: [
                'userlogin' => $this->userlogin,
                'newPassword' => $this->newpassword,
                'fullname' => $this->userfullname,
            ],
        );
    }
}