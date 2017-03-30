<?php

namespace App\Services;

use App\Models\FeedEvent;
use App\Models\FeedEventType;

class FeedEventService
{
    /**
     * @param  int $count
     * @return FeedEvent
     */
    public function getAllPaginated($count = 20)
    {
        return FeedEvent::orderBy('created_at', 'DESC')->paginate($count);
    }

    /**
     * @param  string $name
     * @return FeedEventType
     */
    public function getByName($name)
    {
        return FeedEventType::where('name', $name)->first();
    }
}
