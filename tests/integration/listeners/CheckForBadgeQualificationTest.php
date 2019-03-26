<?php

namespace Tests\Integration\Listeners;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Events\PageWasAdded;
use App\Listeners\CheckForBadgeQualification;

use App\Services\TagService;
use App\Services\UserService;
use App\Services\PageService;
use App\Services\BadgeService;
use App\Services\PageResourceService;
use App\Services\SuggestedEditService;

class CheckForBadgeQualificationTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanHandleEventAndAddBadges()
    {
        $page = factory('App\Models\Page')->create(['approved' => 1]);

        $event = new PageWasAdded($page);

        $listener = new CheckForBadgeQualification(
            new BadgeService,
            new UserService,
            new PageService(
                new TagService
            ),
            new SuggestedEditService,
            new PageResourceService
        );

        $listener->handle($event);

        $this->seeInDatabase('user_badges', [
            'badge_id' => 1,
            'user_id' => $page->created_by,
        ]);
    }
}
