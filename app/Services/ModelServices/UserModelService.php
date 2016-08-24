<?php

namespace App\Services\ModelServices;

use App\Interfaces\SearchableModelService;

use App\Models\User;
use App\Models\Page;
use App\Models\UserBadge;
use App\Models\SuggestedEdit;

class UserModelService implements SearchableModelService
{
    public $user;
    public $communityPageMultiplier = 3;
    public $contributingMultiplier = 5;

    public function __construct($user)
    {
        $this->user = $user;
    }
    public function getSearchResults($term)
    {
        $query = [
            "bool" => [
                "should" => [
                    [ "wildcard" => [ "_all" => "*$term*"]],
                    [ "match" => [ "_all" => "$term" ]]
                ]
            ]
        ];

        return User::searchByQuery($query);
    }

    public function getUserType()
    {
        if ($this->user->curator) {
            $userType = 'Curator';
        }

        $bestBadge = $this->getBestBadge();

        if ($bestBadge == null) {
            $bestBadge = 'This loser has no badges';
        }

        if (isset($userType)) {
            $userType .= ' / ' . $bestBadge;
        } else {
            $userType = $bestBadge;
        }

        return $userType;
    }

    public function searchResultString()
    {
        return 'User: ' . $this->user->name . ' (' . $this->getUserType() . ')';
    }

    public function searchResultUrl()
    {
        return '/u/' . $this->user->slug;
    }

    public function searchResultIcon()
    {
        return '<i class="fa fa-user"></i>';
    }

    public function getRawCommunityData()
    {
        \DB::statement(\DB::raw('set @row:=0'));

        $users = User::select([
                'id',
                'name',
                \DB::raw('(
                    (
                        (
                            SELECT COUNT(*) FROM pages WHERE pages.created_by=users.id
                        ) 
                        * ' . $this->communityPageMultiplier . '
                    ) + (
                        SELECT COUNT(*) FROM suggested_edits WHERE suggested_edits.created_by=users.id AND approved=1
                    ) + (
                        (
                            SELECT COUNT(*) FROM contributors WHERE contributors.user_id=users.id
                        )
                        * ' . $this->contributingMultiplier . '
                    )
                ) as total')
            ])
            ->orderBy('total', 'DESC')
            ->get()
            ->toArray();

        usort($users, function ($a, $b) {
            if ($a['total'] == $b['total']) {
                return 0;
            }

            return ($a['total'] < $b['total']) ? 1 : -1;
        });

        return $users;
    }

    public function getCommunityData()
    {
        $communityData = $this->getRawCommunityData();

        foreach ($communityData as $rank => $user) {
            if ($user['id'] == $this->user->id) {
                $userRank = $rank + 1;
                break;
            }
        }

        return  [
         'rank' => $userRank,
         'score' => $user['total'],
         'badgeCount' => $this->getBadgeCount(),
         'bestBadge' => $this->getBestBadge()
        ];
    }

    public function specialistAreas($limit = null)
    {
        $chaptersEdited = SuggestedEdit::select(
            'pages.slug',
            'suggested_edits.id',
            'suggested_edits.title',
            'suggested_edits.chapter_id',
            \DB::raw('COUNT(suggested_edits.id) as total')
        )
            ->leftJoin('pages', 'pages.id', '=', 'suggested_edits.page_id')
            ->where('suggested_edits.created_by', $this->user->id);
        
        $chaptersSubmittedTo = Page::select(
            'id',
            'slug',
            'title',
            'chapter_id',
            \DB::raw('COUNT(id) as total')
        )
            ->where('created_by', $this->user->id)
            ->union($chaptersEdited)
            ->orderBy('total', 'desc')
            ->groupBy('chapter_id')
            ->limit($limit)
            ->get();

        foreach ($chaptersSubmittedTo as $key => $chapter) {
            if ($chapter->total < 1) {
                unset($chaptersSubmittedTo[$key]);
            }
        }

        return $chaptersSubmittedTo;
    }

    public function getBadgeCount()
    {
        return UserBadge::where('user_id', $this->user->id)
            ->get()
            ->count();
    }

    public function getBestBadge()
    {
        $badge = UserBadge::join('badges', 'badges.id', '=', 'user_badges.badge_id')
            ->where('user_id', $this->user->id)
            ->orderBy('badges.level', 'DESC')
            ->orderBy('user_badges.created_at', 'DESC')
            ->first();

        return is_object($badge) ? $badge->name : null;
    }
}
