<?php

namespace App\Listeners;

use App\Events\UserCreating;
use App\Mail\Register;
use App\Mail\TestMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;

class GmailVerification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserCreating  $event
     * @return void
     */
    public function handle()
    {
        Mail::to(Request()->email)->send(new Register());
    }
}
