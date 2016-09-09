<?php

namespace App\Listeners;

use Illuminate\Http\Request;

use App\Events\BadgeWasAddedToUser;

use App\Models\FeedEvent;
use App\Models\FeedEventType;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddBadgeEventToFeed
{
    public $user;
    public $eventTypeName = 'Badge Earned';

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
    public function handle(BadgeWasAddedToUser $event)
    {
        if (config('global.badges_enabled')) {
            $badge = $event->badge;

            $eventType = $this->getEventType();

            FeedEvent::create([
                'feed_event_type_id' => $eventType->id,
                'user_id' => $badge->user_id,
                'resource_id' => $badge->badge_id
            ]);
        }
    }

    public function getEventType()
    {
        return FeedEventType::where('name', $this->eventTypeName)->first();
    }
}
