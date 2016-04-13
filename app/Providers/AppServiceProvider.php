<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Models\Chapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.master', function($view) {
            $chapters = Chapter::orderBy('order')->get();
            $view->with('chapters', $chapters);
        });
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
