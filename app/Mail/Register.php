<?php

namespace App\Mail;

use App\Services\EmailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Register extends Mailable
{
    use Queueable, SerializesModels;

    public $emailService;
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(EmailService $emailService)
    {
        $this->emailService = $emailService;

        $this->emailService->createUserCode();
        
        return $this->subject('YOUR VERIFICATION MAIL FROM POST SITE')
            ->from('PostSite@mail.dev', 'Verification Mail')
            ->view('Secret-Code', ['data' => Cache::get('email-code')]);
    }
}
