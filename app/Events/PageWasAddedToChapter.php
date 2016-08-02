<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\User;
use App\Models\Page;

class PageWasAddedToChapter extends Event
{
    use SerializesModels;

    public $page;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Page $page, User $user)
    {
        $this->page = $page;
        $this->user = $user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
