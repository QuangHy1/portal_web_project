<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WebsiteMailController extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $body;
    public $user_name;
    public $template;
    public $otp; // nếu dùng OTP

    /**
     * Tạo Mailable có thể dùng được cho nhiều loại user
     */
    public function __construct($subject, $body, $user_name, $template = 'admin.email.emailTemplate', $otp = null)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->user_name = $user_name;
        $this->template = $template;
        $this->otp = $otp;
    }

    /**
     * Xây dựng email
     */
    public function build()
    {
        return $this->view($this->template)
            ->subject($this->subject)
            ->with([
                'subject' => $this->subject,
                'body' => $this->body,
                'user_name' => $this->user_name,
                'otp' => $this->otp,
            ]);
    }
}
