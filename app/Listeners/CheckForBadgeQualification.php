<?php

namespace App\Listeners;

use App\Events\Event;

use App\Services\UserService;
use App\Services\PageService;
use App\Services\BadgeService;

class CheckForBadgeQualification
{
  /**
   * @var BadgeService
   */
    private $badges;

  /**
   * @var UserService
   */
    private $users;

  /**
   * @var PageService
   */
    private $pages;

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
