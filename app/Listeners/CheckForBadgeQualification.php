<?php

namespace App\Listeners;

use App\Events\Event;

use App\Services\UserService;
use App\Services\PageService;
use App\Services\BadgeService;
use App\Services\PageResourceService;
use App\Services\SuggestedEditService;

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
     * @param UserService  $users
     * @param PageService  $pageResources
     */
    public function __construct(
        BadgeService $badges,
        UserService $users,
        PageService $pages,
        SuggestedEditService $suggestedEdits,
        PageResourceService $pageResources
    ) {
        $this->badges = $badges;
        $this->users = $users;
        $this->pages = $pages;
        $this->pageResources = $pageResources;
        $this->suggestedEdits = $suggestedEdits;
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

            if ($event->metric == 'pagesSubmitted') {
              $count = $this->pages->getApprovedByUserId($page->created_by)->count();
            } elseif ($event->metric == 'resourcesSubmitted') {
              $count = $this->pageResources->getByUserId($page->created_by)->count();
            } elseif ($event->metric == 'pagesEdited') {
              $count = $this->suggestedEdits->getApprovedByUserId($page->created_by)->count();
            } else {
              $count = 0;
            }

            $badges = $this->badges->getNewByUserId($creator->id, $event->metric, $count);

            if (!$badges->isEmpty()) {
                $badgeIds = array_pluck($badges, 'id');

                $this->badges->addManyForUser($creator->id, $badgeIds);
            }
        }
    }
}
