<?php

namespace App\Listeners;

use App\Events\Event;

use App\Models\Page;
use App\Models\Badge;

use App\Services\UserService;
use App\Services\PageService;
use App\Services\BadgeService;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckForBadgeQualification
{
  /**
   * @var Badges
   */
    private $badges;

  /**
   * @var User
   */
    private $users;

    /**
     * @param BadgeService $badges
     * @param User         $users
     */
    public function __construct(
        BadgeService $badges,
        UserService $users,
        PageService $pages
    ) {
        $this->badges = $badges;
        $this->users = $users;
        $this->pages = $pages;
    }

    /**
     * Handle the event.
     *
     * @param  Event  $event
     * @return void
     */
    public function handle(Event $event)
    {
        if (env('FEATURE_BADGES_ENABLED', true)) {
            $page = $event->page;
            $creator = $page->creator;

            $count = $this->pages->getApprovedByUserId($page->created_by)->count();

            $badges = $this->badges->getNewByUserId($creator->id, $event->metric, $count);

            if (!$badges->isEmpty()) {
                $badgeIds = array_pluck($badges, 'id');

                $this->badges->addManyForUser($creator->id, $badgeIds);
            }
        }
    }
}
