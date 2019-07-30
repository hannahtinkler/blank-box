<?php

namespace App\Providers;

use Validator;
use Themsaid\Forge\Forge;
use Illuminate\Support\ServiceProvider;
use Themsaid\Forge\Exceptions\NotFoundException;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('validForgeServer', function($attribute, $value, $parameters, $validator) {
            try {
                $exists = app(Forge::class)->server($value);
            } catch(NotFoundException $e) {
                $exists = false;
            }

            return $exists;
        }, "There are no servers with this ID");

        Validator::extend('validForgeSite', function($attribute, $value, $parameters, $validator) {
            try {
                $exists = app(Forge::class)->site($parameters[0], $value);
            } catch(NotFoundException $e) {
                $exists = false;
            }

            return $exists;
        }, "There are no sites on this server with this ID");
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
