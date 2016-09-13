<?php

namespace App\Observers\Elasticsearch;

use App\Models\User;
use Elasticsearch\Client;

class UserObserver
{
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function created(User $user)
    {
        $user->addToIndex();
    }

    public function updated(User $user)
    {
        $user->addToIndex();
    }

    public function deleted(User $user)
    {
        $this->elasticsearch->delete([
            'index' => env('ELASTICSEARCH_INDEX', 'default'),
            'type' => 'users',
            'id' => $user->id
        ]);
    }
}
