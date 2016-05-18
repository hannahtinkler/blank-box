<?php

namespace App\Observers\Elasticsearch;

use App\Models\Page;
use Elasticsearch\Client;

class PageObserver
{
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function created(Page $page)
    {
        $page->addToIndex();
    }

    public function updated(Page $page)
    {
        $page->addToIndex();
    }

    public function deleted(Page $page)
    {
        $this->elasticsearch->delete([
            'index' => 'default',
            'type' => 'pages',
            'id' => $page->id
        ]);
    }
}
