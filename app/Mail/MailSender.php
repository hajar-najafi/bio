<?php

namespace App\Mail;

use http\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSender extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $name;
    public $email;
    public $phone;
    public string $msg;
    public function __construct($name,$email,$phone,$message)
    {
        $this->name=$name;
        $this->email=$email;
        $this->phone=$phone;
        $this->msg=$message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('sendmail');
    }
}
