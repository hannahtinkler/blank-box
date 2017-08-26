<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\Page;

class PageWasEdited extends Event
{
    use SerializesModels;

    /**
     * @var Page
     */
    public $page;

    /**
     * @var string
     */
    public $metric = 'pagesEdited';

    /**
     * @param Page $page
     */
    public function __construct(Page $resource)
    {
        $this->page = $resource;
    }

    /**
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
