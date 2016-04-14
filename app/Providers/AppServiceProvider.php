<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Models\Chapter;
use App\Library\Models\Bookmark;
use App\Library\Models\Page;
use App\Library\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.master', function ($view) {

            if (\Request::segment(1) == 'p') {
                $current = [];
                $current['category'] = Category::where('slug', \Request::segment(2))->first();
                $current['chapter'] = Chapter::where('slug', \Request::segment(3))->first();
                $current['page'] = Page::where('slug', \Request::segment(4))->first();
            } else {
                $current = null;
            }

            $categories = Category::orderBy('order')->get();
            $bookmarks = Bookmark::all()->count();

            $view->with('categories', $categories)
                ->with('current', $current)
                ->with('bookmarks', $bookmarks);
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
