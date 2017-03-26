<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\Page;

class PageWasAdded extends Event
{
    use SerializesModels;

    /**
     * @var Page
     */
    public $page;

    /**
     * @var string
     */
    public $metric = 'pagesSubmitted';

    /**
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
