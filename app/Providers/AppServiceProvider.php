<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Chapter;
use App\Models\Bookmark;
use App\Models\Page;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerBladeExtension();
        $this->registerViewComposer();
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

    public function registerBladeExtension()
    {
        $blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();
        
        $blade->extend(function ($value, $compiler) {
            $value = preg_replace("/@set\('(.*?)'\,(.*)\)/", '<?php $$1 = $2; ?>', $value);
            return $value;
        });
    }

    public function registerViewComposer()
    {
        view()->composer('layouts.master', function ($view) {
            $current = [];
            $current['category'] = $this->getCurrentCategory();

            if (\Request::segment(1) == 'p') {
                $current['chapter'] = Chapter::where('slug', \Request::segment(3))->first();
                $current['page'] = Page::where('slug', \Request::segment(4))->first();
            }

            $categories = Category::orderBy('order')->get();
            $bookmarks = Bookmark::all()->count();

            $view->with('categories', $categories)
                ->with('current', $current)
                ->with('current', $current)
                ->with('bookmarks', $bookmarks);
        });
    }

    public function getCurrentCategory()
    {
        if (!\Session::has('currentCategoryId')) {
            $category = Category::first();
            \Session::set('currentCategoryId', $category->id);
        } else {
            $category = Category::find(\Session::get('currentCategoryId'));
        }

        return $category;
    }
}
