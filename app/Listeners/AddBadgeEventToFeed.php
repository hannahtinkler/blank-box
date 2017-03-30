<?php

namespace App\Listeners;

use Illuminate\Http\Request;

use App\Models\FeedEvent;
use App\Services\FeedEventService;
use App\Events\BadgeWasAddedToUser;

class AddBadgeEventToFeed
{
    /**
     * @var FeedEventService
     */
    private $feedEvents;

    /**
     * @var string
     */
    private $eventTypeName = 'Badge Earned';

    /**
     * @param FeedEventService $badges
     */
    public function __construct(
        FeedEventService $feedEvents
    ) {
        $this->feedEvents = $feedEvents;
    }

    /**
     * Handle the event.
     *
     * @param  PageWasAddedToChapter  $event
     * @return void
     */
    public function handle(BadgeWasAddedToUser $event)
    {
        if (env('FEATURE_BADGES_ENABLED', true)) {
            $badge = $event->badge;

            $eventType =  $this->feedEvents->getByName($this->eventTypeName);

            FeedEvent::create([
                'feed_event_type_id' =>$eventType->id,
                'user_id' => $badge->user_id,
                'resource_id' => $badge->badge_id
            ]);
        }
    }
}
