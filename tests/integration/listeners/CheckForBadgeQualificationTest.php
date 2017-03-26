<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Page;

use App\Events\PageWasAdded;
use App\Listeners\CheckForBadgeQualification;

use App\Services\UserService;
use App\Services\PageService;
use App\Services\BadgeService;

class CheckForBadgeQualificationTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanHandleEventAndAddBadges()
    {
        $page = factory(Page::class)->create(['approved' => true]);

        $event = new PageWasAdded($page);

        $listener = new CheckForBadgeQualification(
            new BadgeService,
            new UserService,
            new PageService
        );

        $listener->handle($event);

        $this->seeInDatabase('user_badges', [
            'badge_id' => 1,
            'user_id' => $page->created_by,
        ]);
    }
}
