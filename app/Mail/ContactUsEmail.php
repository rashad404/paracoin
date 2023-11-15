<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsEmail extends Mailable
{
    use Queueable, SerializesModels;


    protected $mailData;
    public function __construct($data)
    {
        $this->mailData = $data;
    }

    public function build()
    {
        return $this->view('mail.contact-us')
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject(env('APP_NAME').'Message from Contact form')
            ->replyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->with(['data' => $this->mailData]);
    }
}
