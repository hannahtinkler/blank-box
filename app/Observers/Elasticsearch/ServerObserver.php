<?php

namespace App\Observers\Elasticsearch;

use App\Models\Server;
use Elasticsearch\Client;

class ServerObserver
{
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function created(Server $server)
    {
        $server->addToIndex();
    }

    public function updated(Server $server)
    {
        $server->addToIndex();
    }

    public function deleted(Server $server)
    {
        $this->elasticsearch->delete([
            'index' => 'default',
            'type' => 'servers',
            'id' => $server->id
        ]);
    }
}
