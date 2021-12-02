<?php

namespace App\Providers;

use App\Model\User;
use App\Model\UserSearchHistories;
use App\Observers\UserObserver;
use App\Observers\UserSearchHistoryObserver;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        // Observers
        User::observe(UserObserver::class);
        UserSearchHistories::observe(UserSearchHistoryObserver::class);
    }
}
