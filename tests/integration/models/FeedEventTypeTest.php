<?php

namespace Tests\Integration\Models;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\FeedEvent;

class FeedEventTypeTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Tests that a call to the badges relationship returns a collection
     * object containing instances of the FeedEvent class
     *
     * @return void
     */
    public function testFeedEventsRelationshipReturnsFeedEvents()
    {
        $type = factory('App\Models\FeedEventType')->create();
        factory('App\Models\FeedEvent', 2)->create(['feed_event_type_id' => $type->id]);

        $this->assertTrue($type->feedEvents->first() instanceof FeedEvent);
    }
}
