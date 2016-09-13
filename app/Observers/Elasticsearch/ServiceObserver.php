<?php

namespace App\Observers\Elasticsearch;

use App\Models\Service;
use Elasticsearch\Client;

class ServiceObserver
{
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function created(Service $service)
    {
        $service->addToIndex();
    }

    public function updated(Service $service)
    {
        $service->addToIndex();
    }

    public function deleted(Service $service)
    {
        $this->elasticsearch->delete([
            'index' => env('ELASTICSEARCH_INDEX', 'default'),
            'type' => 'services',
            'id' => $service->id
        ]);
    }
}
