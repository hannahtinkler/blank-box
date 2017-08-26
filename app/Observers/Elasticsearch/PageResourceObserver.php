<?php

namespace App\Observers\Elasticsearch;

use App\Models\PageResource;
use Elasticsearch\Client;

class PageResourceObserver
{
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function created(PageResource $resource)
    {
        $resource->addToIndex();
    }

    public function updated(PageResource $resource)
    {
        $resource->addToIndex();
    }

    public function deleted(PageResource $resource)
    {
        $this->elasticsearch->delete([
            'index' => env('ELASTICSEARCH_INDEX', 'default'),
            'type' => 'pageresource',
            'id' => $resource->id
        ]);
    }
}
