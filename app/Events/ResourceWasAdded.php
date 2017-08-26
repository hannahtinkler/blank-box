<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\PageResource;

class ResourceWasAdded extends Event
{
    use SerializesModels;

    /**
     * @var PageResource
     */
    public $page;

    /**
     * @var string
     */
    public $metric = 'resourcesSubmitted';

    /**
     * @param Page $page
     */
    public function __construct(PageResource $resource)
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
