<?php

namespace App\Listeners;

use App\Models\FeedEvent;
use App\Models\FeedEventType;

use App\Events\PageWasAddedToChapter;

use Illuminate\Http\Request;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddPageEventToFeed
{
    public $user;
    public $eventTypeName = 'Page Added';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->user = $request->user();
    }

    /**
     * Handle the event.
     *
     * @param  PageWasAddedToChapter  $event
     * @return void
     */
    public function handle(PageWasAddedToChapter $event)
    {
        $page = $event->page;

        $eventType = $this->getEventType();

        FeedEvent::create([
            'feed_event_type_id' => $eventType->id,
            'user_id' => $page->created_by,
            'resource_id' => $page->id
        ]);
    }

    public function getEventType()
    {
        return FeedEventType::where('name', $this->eventTypeName)->first();
    }
}