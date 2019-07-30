<?php

namespace App\Providers;

use Themsaid\Forge\Forge;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(Forge::class, function () {
            return new Forge(config('services.forge.api_token'));
        });
    }
}
