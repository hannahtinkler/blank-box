<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Models\Chapter;
use App\Library\Models\Bookmark;
use App\Library\Models\Page;

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
            $currentChapter = \Request::segment(1) == 'chapter' ? Chapter::where('slug', \Request::segment(2))->first() : null;
            $currentPage = \Request::segment(1) == 'chapter' && \Request::segment(3) ? Page::where('slug', \Request::segment(3))->first() : null;

            $chapters = Chapter::orderBy('order')->get();
            $bookmarks = Bookmark::all()->count();

            $view->with('chapters', $chapters)
                ->with('currentPage', $currentPage)
                ->with('currentChapter', $currentChapter)
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
