<?php

use App\Models\FeedEvent;
use App\Services\ModelServices\FeedEventModelService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FeedEventModelServiceTest extends TestCase
{
    /**
     * The current feedEvent being used in the test
     * @var object FeedEvent
     */
    public $feedEvent;

    public function testGetTextMethodReturnsCorrectTextForPageAdded()
    {
        $page = factory(App\Models\Page::class)->create();
        
        $modelService = $this->getFeedEventModelService('Page Added', ['resource_id' => $page->id]);

        $actual = $modelService->getText();

        $expected = sprintf(
            $this->feedEvent->type->text,
            '<a href="/u/' . $this->feedEvent->user->slug .'">' . $this->feedEvent->user->name . '</a>',
            '<a href="/p/' . $page->chapter->category->slug .'/' . $page->chapter->slug . '">' . $page->chapter->title . '</a>',
            '<a href="/p/' . $page->chapter->category->slug .'/' . $page->chapter->slug . '/' . $page->slug . '">' . $page->title . '</a>'
        );

        $this->assertEquals($expected, $actual);
    }

    public function testGetTextMethodReturnsCorrectTextForBadgeEarned()
    {
        $badge = factory(App\Models\Badge::class)->create();
        
        $modelService = $this->getFeedEventModelService('Badge Earned', ['resource_id' => $badge->id]);

        $actual = $modelService->getText();

        $expected = sprintf(
            $this->feedEvent->type->text,
            '<a href="/u/' . $this->feedEvent->user->slug .'">' . $this->feedEvent->user->name . '</a>',
            '<a href="/u/' . $this->feedEvent->user->slug .'/badges">' . $badge->name . '</a>'
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * Create instance of FeedEventModelService class
     *
     * @return void
     */
    private function getFeedEventModelService($type, $overrides = [])
    {
        $type = factory(App\Models\FeedEventType::class)->create(['name' => $type]);
        $this->feedEvent = factory(App\Models\FeedEvent::class)->create(array_merge($overrides, ['feed_event_type_id' => $type->id]));

        return new FeedEventModelService($this->feedEvent);
    }
}
