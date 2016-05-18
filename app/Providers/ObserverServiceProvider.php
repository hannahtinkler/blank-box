<?php

namespace App\Providers;

use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

use App\Models\Page;
use App\Models\Chapter;
use App\Models\Server;
use App\Models\Service;
use App\Models\User;

use App\Observers\Elasticsearch\PageObserver;
use App\Observers\Elasticsearch\ChapterObserver;
use App\Observers\Elasticsearch\ServerObserver;
use App\Observers\Elasticsearch\ServiceObserver;
use App\Observers\Elasticsearch\UserObserver;

class ObserverServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Page::observe($this->app->make(PageObserver::class));
        Chapter::observe($this->app->make(ChapterObserver::class));
        Server::observe($this->app->make(ServerObserver::class));
        Service::observe($this->app->make(ServiceObserver::class));
        User::observe($this->app->make(UserObserver::class));
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

        $this->app->singleton(ServerObserver::class, function () {
            $client = ClientBuilder::create()->build();
            return new ServerObserver($client);
        });

        $this->app->singleton(ServiceObserver::class, function () {
            $client = ClientBuilder::create()->build();
            return new ServiceObserver($client);
        });

        $this->app->singleton(UserObserver::class, function () {
            $client = ClientBuilder::create()->build();
            return new UserObserver($client);
        });
    }
}
