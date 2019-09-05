<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\{Mail, User};

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $mail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('contact.mail')->with([
            'from' => $this->mail->user->email,
            'subject' => $this->mail->subject,
            'content' => $this->mail->content
        ]);
    }
}
