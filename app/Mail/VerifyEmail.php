<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $token;
    public $user_name;
    public $body;

    /**
     * Tạo đối tượng mới.
     */
    public function __construct($email, $token, $user_name, $body)
    {
        $this->email = $email;
        $this->token = $token;
        $this->user_name = $user_name;
        $this->body = $body;
    }

    /**
     * Xây dựng email gửi đi.
     */
    public function build()
    {
        $verifyUrl = url('/verify-email?email=' . urlencode($this->email) . '&token=' . urlencode($this->token));

        return $this->subject('Xác minh địa chỉ Email của bạn')
            ->view('admin.email.verifyEmail')
            ->with([
                'verifyUrl' => $verifyUrl,
                'user_name' => $this->user_name,
                'body' => $this->body,
            ]);
    }
}
