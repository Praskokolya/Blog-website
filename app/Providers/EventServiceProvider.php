<?php

namespace App\Providers;

use App\Events\UserCreating;
use App\Listeners\GmailVerification;
use App\Models\RegistredUsers;
use App\Observers\RegistredUsersObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserCreating::class => [
            GmailVerification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        RegistredUsers::observe(RegistredUsersObserver::class);
    }
}
