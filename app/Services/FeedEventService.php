<?php

namespace App\Services;

use App\Models\FeedEvent;

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
}
