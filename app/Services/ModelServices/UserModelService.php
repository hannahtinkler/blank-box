<?php

namespace App\Services\ModelServices;

use App\Interfaces\SearchableModelService;

use App\Models\User;
use App\Models\Page;
use App\Models\SuggestedEdit;

class UserModelService implements SearchableModelService
{
    public $user;

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

    public function specialistAreas($limit = null)
    {
        $chaptersEdited = SuggestedEdit::select(
                'pages.slug',
                'suggested_edits.id',
                'suggested_edits.title',
                'suggested_edits.chapter_id',
                \DB::raw('COUNT(suggested_edits.id) as total')
            )
            ->join('pages', 'pages.id', '=', 'suggested_edits.page_id')
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

        return $chaptersSubmittedTo;
    }
}
