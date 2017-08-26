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

        $bestBadge = $this->badgeService->getBestByUserId($this->user->id);

        if ($bestBadge) {
            $string .= ' (' . $bestBadge->name . ')';
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
     * @return array
     */
    public function specialistAreas()
    {
        return DB::select(
            DB::raw(
                "SELECT
                    chapters.title as title,
                    chapters.slug as chapterSlug,
                    categories.slug as categorySlug,
                    IFNULL(
                        (
                            SELECT COUNT(*)
                            FROM pages
                            WHERE chapter_id = chapters.id
                            AND created_by = ?
                            GROUP BY chapter_id
                        ),
                        0
                    ) + IFNULL(
                        (
                            SELECT COUNT(*)
                            FROM suggested_edits
                            WHERE chapter_id = chapters.id
                            AND created_by = ?
                            GROUP BY chapter_id
                        ),
                        0
                    ) as total
                FROM chapters
                JOIN categories ON categories.id = chapters.category_id
                HAVING total > 0"
            ),
            [
                $this->user->id,
                $this->user->id,
            ]
        );
    }
}
