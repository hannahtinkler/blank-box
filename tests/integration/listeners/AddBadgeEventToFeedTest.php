<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\FeedEventService;
use App\Events\BadgeWasAddedToUser;
use App\Listeners\AddBadgeEventToFeed;

class AddBadgeEventToFeedTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanHandleEventAndAddfeedEvent()
    {
        $badge = factory('App\Models\UserBadge')->create();

        $event = new BadgeWasAddedToUser($badge);

        $listener = new AddBadgeEventToFeed(
            new FeedEventService
        );

        $listener->handle($event);

        $this->seeInDatabase('feed_events', [
            'feed_event_type_id' => 2,
            'resource_id' => $badge->badge_id,
            'user_id' => $badge->user_id,
        ]);
    }
}
