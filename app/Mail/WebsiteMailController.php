<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WebsiteMailController extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $body;
    public $company_name;
    public $template;

    public function __construct($subject, $body, $company_name, $template = 'admin.email.emailTemplate')
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->company_name = $company_name;
        $this->template = $template;
    }

    public function build()
    {
        return $this->view($this->template)
        ->with('subject', $this->subject)
        ->with('body', $this->body)
        ->with('employer_name', $this->company_name);
    }
}
