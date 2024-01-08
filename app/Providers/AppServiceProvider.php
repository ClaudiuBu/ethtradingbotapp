<?php

namespace App\Providers;

use App\Services\Web3\Web3Connection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton('web3_connection', function () {
            return new Web3Connection();
        });
    }
}
