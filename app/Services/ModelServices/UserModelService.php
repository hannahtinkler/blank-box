<?php

namespace App\Services\ModelServices;

use App\Interfaces\SearchableModelService;

use App\Models\User;
use App\Models\Page;
use App\Models\SuggestedEdit;

class UserModelService implements SearchableModelService
{
    public $user;
    public $communityPageMultiplier = 3;

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
        } elseif (!$this->user->pages->isEmpty()) {
            $userType = 'Contributor';
        } else {
            $userType = 'Reader';
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

        return User::select([
                'id',
                \DB::raw('(
                    (
                        (
                            SELECT COUNT(*) FROM pages WHERE pages.created_by=users.id
                        ) 
                        * ' . $this->communityPageMultiplier . '
                    ) + (
                        SELECT COUNT(*) FROM suggested_edits WHERE suggested_edits.created_by=users.id AND approved=1
                    )
                ) as total'),
                \DB::raw('@row:=@row+1 as rank')
            ])
            ->orderBy('total', 'DESC')
            ->get();
    }

    public function getCommunityData()
    {
        $communityData = $this->getRawCommunityData();

        foreach ($communityData as $user) {
            if ($user->id == $this->user->id) {
                $userRank = $user;
                break;
            }
        }

        return  [
         'rank' => $user->rank,
         'score' => $user->total,
         'title' => $this->getUserTitle($score)
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

    public function getUserTitle($score)
    {
        $titles = [
            200 => 'Monarque de Mayden',
            170 => 'Admiral of AJAX',
            150 => 'Vice Admiral of Validation',
            130 => 'Rear Admiral of Reports',
            110 => 'Commodore of Courses',
            110 => 'Captain of Caches',
            90 => 'Lieutenant Commander of Letters',
            80 => 'Lieutenant of Logger',
            70 => 'Sub-Lieutenant of Supervision',
            60 => 'Midshipman of MDS',
            50 => 'Online Provider Wrangler',
            40 => 'Probably-Has-Too-Much-Time-On-Their-Hands',
            30 => 'Probably-Could-Teach-At-Hogwarts',
            20 => 'SMS Smasher',
            15 => 'Specialism Hunter',
            10 => 'Prolific Publisher',
            5 => 'RunReportLibrary Lover',
            1 => 'The Have-A-Go Harry',
            0 => 'Postroom Proofreader',
        ];
    }
}
