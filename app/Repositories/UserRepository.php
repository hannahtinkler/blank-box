<?php

namespace App\Repositories;

use DB;

use App\Models\User;
use App\Models\Page;
use App\Models\SuggestedEdit;

use App\Services\UserService;
use App\Services\BadgeService;
use App\Interfaces\SearchableRepository;

class UserRepository implements SearchableRepository
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var BadgeService
     */
    private $badgeService;
    
    /**
     * @param User         $user
     * @param UserService  $userService
     * @param BadgeService $badgeService
     */
    public function __construct(User $user, UserService $userService, BadgeService $badgeService)
    {
        $this->user = $user;
        $this->userService = $userService;
        $this->badgeService = $badgeService;
    }

    /**
     * @return string
     */
    public function searchResultString()
    {
        $string = 'User: ' . $this->user->name;

        if (env('FEATURE_CURATION_ENABLED') && $this->user->curator) {
            $string .= ' (Curator)';
        }

        return $string;
    }

    /**
     * @return string
     */
    public function searchResultUrl()
    {
        return sprintf('/u/%s', $this->user->slug);
    }

    /**
     * @return string
     */
    public function searchResultIcon()
    {
        return '<i class="fa fa-user"></i>';
    }

    /**
     * @return array
     */
    public function communityData()
    {
        $user = $this->user;

        $bestBadge = $this->badgeService->getBestByUserId($this->user->id);

        $communityData = $this->userService->getAllContributionTotals()
            ->map(function ($record, $key) {
                $record->rank = $key + 1;
                return $record;
            })
            ->filter(function ($record) use ($user) {
                return $record['id'] == $user->id;
            })
            ->first();

        return  [
            'rank' => $communityData->rank,
            'total' => $communityData->total,
            'badgeCount' => $user->userBadges->count(),
            'bestBadge' => $bestBadge ? $bestBadge->name : null,
        ];
    }

    /**
     * Okay, this is ridiculous. We want a list of chapters the user has
     * submitted pages and edits to along with the count of edits/pages per
     * chapter, where the count is greater than 1. It shouldn't be this hard.
     * Maybe it isn't. Maybe I'm just an idiot.
     *
     * @return Collection
     */
    public function specialistAreas()
    {
        $edits = SuggestedEdit::select([
            'chapter_id',
            DB::raw('COUNT(*) as total')
        ])
        ->where('created_by', $this->user->id)
        ->groupBy('chapter_id')
        ->get()
        ->keyBy('chapter_id')
        ->map(function ($row) {
            return $row->total;
        });
        
        $pages = Page::select([
            'chapter_id',
            DB::raw('COUNT(*) as total')
        ])
        ->where('created_by', $this->user->id)
        ->groupBy('chapter_id')
        ->get()
        ->keyBy('chapter_id')
        ->map(function ($row) {
            return $row->total;
        });

        foreach ($edits as $chapterId => $total) {
            if (isset($pages[$chapterId])) {
                $pages[$chapterId] += $total;
            } else {
                $pages[$chapterId] = $total;
            }
        }

        $pages = $pages->filter(function ($page) {
            return $page > 1;
        });

        return $pages;
    }
}
