<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectEmployerAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $email;
    public $body;

    public function __construct($username, $email, $body)
    {
        $this->username = $username;
        $this->email = $email;
        $this->body     = $body;
    }

    public function build()
    {
        return $this->subject('Tài khoản của bạn không được phê duyệt')
            ->view('admin.email.rejectAccEmployer')
            ->with([
                'username' => $this->username,
                'email' => $this->email,
                'body' => $this->body,
            ]);
    }
}
