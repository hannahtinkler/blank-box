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
        Validator::extend('validForgeSite', function($attribute, $value, $parameters, $validator) {
            try {
                $exists = app(Forge::class)->site($parameters[0], $value);
            } catch(NotFoundException $e) {
                $exists = false;
            }

            return $exists;
        }, "There is a problem with the server or site ID you entered.");
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
