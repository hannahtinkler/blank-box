<?php

namespace App\Listeners;

use App\Models\FeedEvent;
use App\Models\FeedEventType;

use App\Events\PageWasAdded;

use Illuminate\Http\Request;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddPageEventToFeed
{
    /**
     * @var string
     */
    public $eventTypeName = 'Page Added';

    /**
     * Handle the event.
     *
     * @param  PageWasAdded  $event
     * @return void
     */
    public function handle(PageWasAdded $event)
    {
        $page = $event->page;

        $eventType = $this->getEventType();

        if ($eventType) {
            FeedEvent::create([
                'feed_event_type_id' => $eventType->id,
                'user_id' => $page->created_by,
                'resource_id' => $page->id
            ]);
        }
    }

    public function getEventType()
    {
        return FeedEventType::where('name', $this->eventTypeName)->first();
    }
}
