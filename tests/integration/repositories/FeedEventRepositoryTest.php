<?php

namespace Tests\Integration\Repositories;

use TestCase;

use App\Models\Page;
use App\Models\Badge;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class FeedEventRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    
    public function testItCanGetTextForPageAdded()
    {
        $page = factory('App\Models\Page')->create();
        
        $feedEvent = factory('App\Models\FeedEvent')->create([
            'resource_id' => $page->id,
            'feed_event_type_id' => 1,
        ]);

        $expected = sprintf(
            $feedEvent->type->text,
            '<a href="/u/' . $feedEvent->user->slug .'">' . $feedEvent->user->name . '</a>',
            '<a href="/p/' . $page->chapter->category->slug .'/' . $page->chapter->slug . '">' . $page->chapter->title . '</a>',
            '<a href="/p/' . $page->chapter->category->slug .'/' . $page->chapter->slug . '/' . $page->slug . '">' . $page->title . '</a>'
        );

        $actual = $feedEvent->text;

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetTextForBadgeEarned()
    {
        $badge = factory('App\Models\Badge')->create();
        
        $feedEvent = factory('App\Models\FeedEvent')->create([
            'resource_id' => $badge->id,
            'feed_event_type_id' => 2,
        ]);

        $expected = sprintf(
            $feedEvent->type->text,
            '<a href="/u/' . $feedEvent->user->slug .'">' . $feedEvent->user->name . '</a>',
            '<a href="/u/' . $feedEvent->user->slug .'/badges">' . $badge->name . '</a>'
        );

        $actual = $feedEvent->text;

        $this->assertEquals($expected, $actual);
    }
 
    public function testItCanGetImageForPageAdded()
    {
        $page = factory('App\Models\Page')->create();
        
        $feedEvent = factory('App\Models\FeedEvent')->create([
            'resource_id' => $page->id,
            'feed_event_type_id' => 1,
        ]);

        $expected = '<i class="feed-icon fa fa-file"></i>';

        $actual = $feedEvent->image;

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetImageForBadgeEarned()
    {
        $badge = factory('App\Models\Badge')->create();
        
        $feedEvent = factory('App\Models\FeedEvent')->create([
            'resource_id' => $badge->id,
            'feed_event_type_id' => 2,
        ]);

        $expected = '<img src="' . $badge->image . '" />';

        $actual = $feedEvent->image;

        $this->assertEquals($expected, $actual);
    }
 
    public function testItCanTellPageExists()
    {
        $page = factory('App\Models\Page')->create();
        
        $feedEvent = factory('App\Models\FeedEvent')->create([
            'resource_id' => $page->id,
            'feed_event_type_id' => 1,
        ]);

        $exists = $feedEvent->resourceExists;

        $this->assertTrue($exists);
    }

    public function testItCanTellBadgeExists()
    {
        $badge = factory('App\Models\Badge')->create();
        
        $feedEvent = factory('App\Models\FeedEvent')->create([
            'resource_id' => $badge->id,
            'feed_event_type_id' => 2,
        ]);

        $exists = $feedEvent->resourceExists;

        $this->assertTrue($exists);
    }
 
    public function testItCanTellPageDoesNotExist()
    {
        $page = new Page;
        
        $feedEvent = factory('App\Models\FeedEvent')->create([
            'resource_id' => 999,
            'feed_event_type_id' => 1,
        ]);

        $exists = $feedEvent->resourceExists;

        $this->assertFalse($exists);
    }

    public function testItCanTellBadgeDoesNotExist()
    {
        $badge = new Badge;
        
        $feedEvent = factory('App\Models\FeedEvent')->create([
            'resource_id' => 999,
            'feed_event_type_id' => 2,
        ]);

        $exists = $feedEvent->resourceExists;

        $this->assertFalse($exists);
    }
}
