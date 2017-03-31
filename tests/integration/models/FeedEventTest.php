<?php

namespace Tests\Integration\Models;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\User;
use App\Models\FeedEventType;

class FeedEventTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Tests that a call to the type relationship returns an
     * object of the FeedEventType class
     *
     * @return void
     */
    public function testFeedEventTypeRelationshipReturnsFeedEventType()
    {
        $type = factory('App\Models\FeedEventType')->create();
        $event = factory('App\Models\FeedEvent')->create(['feed_event_type_id' => $type->id]);

        $this->assertTrue($event->type instanceof FeedEventType);
    }

    /**
     * Tests that a call to the user relationship returns an
     * object of the User class
     *
     * @return void
     */
    public function testUserTypeRelationshipReturnsUserType()
    {
        $user = factory('App\Models\User')->create();
        $event = factory('App\Models\FeedEvent')->create(['user_id' => $user->id]);

        $this->assertTrue($event->user instanceof User);
    }
}
