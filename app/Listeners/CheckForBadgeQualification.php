<?php

namespace App\Listeners;

use App\Models\Page;
use App\Models\Badge;

use App\Events\PageWasAddedToChapter;

use App\Services\ControllerServices\UserBadgeControllerService;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckForBadgeQualification
{
    private $page;
    private $metric = 'pagesSubmittedInChapter';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserBadgeControllerService $userBadgeControllerService)
    {
        $this->userBadgeControllerService = $userBadgeControllerService;
    }

    /**
     * Handle the event.
     *
     * @param  PageWasAddedToChapter  $event
     * @return void
     */
    public function handle(PageWasAddedToChapter $event)
    {
        if (config('global.badges_enabled')) {
            $this->page = $event->page;

            $count = $this->getPageCountForChapter();
            $newBadges = $this->getNewlyQualifiedForBadges($count);

            if (!$newBadges->isEmpty()) {
                $this->userBadgeControllerService->addBadgesForUser($newBadges);
            }
        }
    }

    public function getPageCountForChapter()
    {
        return Page::where('chapter_id', $this->page->chapter_id)
            ->where('created_by', $this->page->created_by)
            ->where('approved', 1)
            ->get()
            ->count();
    }

    public function getNewlyQualifiedForBadges($count)
    {
        $userId = $this->page->created_by;
        
        return Badge::select('badges.*')
            ->leftJoin('badge_groups', 'badges.badge_group_id', '=', 'badge_groups.id')
            ->leftJoin('badge_types', 'badge_groups.badge_type_id', '=', 'badge_types.id')
            ->where('badge_types.metric', $this->metric)
            ->where('badge_groups.metric_entity', $this->page->chapter_id)
            ->where('badges.metric_boundary', '<=', $count)
            ->whereNotIn('badges.id', function ($query) use ($userId) {
                $query->select('badge_id')
                  ->from('user_badges')
                  ->where('user_id', $userId);
            })
            ->orderBy('badges.metric_boundary')
            ->get();
    }
}
