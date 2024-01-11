<?php

namespace App\Providers;

use App\Http\View\Composers\FeedComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\HeaderComposer;
use App\Http\View\Composers\UserComposer;
use App\Http\View\Composers\UserProfileComposer;;

use Illuminate\Pagination\Paginator;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        View::composer('includes.header', HeaderComposer::class);
        View::composer('user.CurrentUserProfile', UserComposer::class);
        View::composer('feed', FeedComposer::class);
        View::composer('user.UserProfile', UserProfileComposer::class);

    }
}
