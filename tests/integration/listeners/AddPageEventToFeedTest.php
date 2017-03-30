<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\FeedEventService;
use App\Events\PageWasAdded;
use App\Listeners\AddPageEventToFeed;

class AddPageEventToFeedTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanHandleEventAndAddfeedEvent()
    {
        $page = factory('App\Models\Page')->create();

        $event = new PageWasAdded($page);

        $listener = new AddPageEventToFeed(
            new FeedEventService
        );

        $listener->handle($event);

        $this->seeInDatabase('feed_events', [
            'feed_event_type_id' => 1,
            'resource_id' => $page->id,
            'user_id' => $page->created_by,
        ]);
    }
}
