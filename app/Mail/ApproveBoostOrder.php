<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApproveBoostOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $email;
    public $body;

    public function __construct($username, $email, $body)
    {
        $this->username = $username;
        $this->email = $email;
        $this->body = $body;
    }

    public function build()
    {
        return $this->subject('Giao dịch Boost của bạn đã được duyệt')
            ->view('admin.email.approveBoostOrder')
            ->with([
                'username' => $this->username,
                'email' => $this->email,
                'body' => $this->body,
            ]);
    }
}
