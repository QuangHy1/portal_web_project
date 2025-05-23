<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $employeeName;
    public $jobTitle;
    public $companyName;
    public $loginUrl;
    public $body;

    public function __construct($employeeName, $jobTitle, $companyName, $loginUrl, $body)
    {
        $this->employeeName = $employeeName;
        $this->jobTitle = $jobTitle;
        $this->companyName = $companyName;
        $this->loginUrl = $loginUrl;
        $this->body = $body;
    }

    public function build()
    {
        return $this->subject('Đơn ứng tuyển của bạn đã bị từ chối')
            ->view('admin.email.rejectApplicationEmployee');
    }
}

