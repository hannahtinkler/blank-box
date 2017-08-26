<?php

namespace App\Providers;

use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

use App\Models\Page;
use App\Models\Chapter;
use App\Models\User;
use App\Models\PageResource;

use App\Observers\Elasticsearch\PageObserver;
use App\Observers\Elasticsearch\ChapterObserver;
use App\Observers\Elasticsearch\PageResourceObserver;
use App\Observers\Elasticsearch\ServerObserver;
use App\Observers\Elasticsearch\ServiceObserver;
use App\Observers\Elasticsearch\UserObserver;

class ObserverServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Page::observe($this->app->make(PageObserver::class));
        Chapter::observe($this->app->make(ChapterObserver::class));
        User::observe($this->app->make(UserObserver::class));
        PageResource::observe($this->app->make(PageResourceObserver::class));
    }

    public function register()
    {
        $this->app->singleton(PageObserver::class, function () {
            $client = ClientBuilder::create()->build();
            return new PageObserver($client);
        });

        $this->app->singleton(ChapterObserver::class, function () {
            $client = ClientBuilder::create()->build();
            return new ChapterObserver($client);
        });

        $this->app->singleton(UserObserver::class, function () {
            $client = ClientBuilder::create()->build();
            return new UserObserver($client);
        });

        $this->app->singleton(PageResourceObserver::class, function () {
            $client = ClientBuilder::create()->build();
            return new PageResourceObserver($client);
        });
    }
}
