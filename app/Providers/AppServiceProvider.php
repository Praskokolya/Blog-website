<?php

namespace App\Providers;

use App\Exports\ContactsExport;
use App\Models\Contact;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ContactsExport::class, function ($app) {
            return new ContactsExport($app->make(Contact::class));
        });    
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
