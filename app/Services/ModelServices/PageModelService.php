<?php

namespace App\Services\ModelServices;

use Auth;
use App\Models\Page;
use App\Interfaces\SearchableModelService;

class PageModelService implements SearchableModelService
{
    public $page;
    public $user;

    public function __construct($page, $user = null)
    {
        $this->page = $page;
        $this->user = $user ?: Auth::user();
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

        return Page::searchByQuery($query);
    }

    public function editableByUser()
    {
        return $this->page->created_by == $this->user->id || $this->user->curator;
    }

    public function searchResultString()
    {
        return 'Page: ' . $this->page->title;
    }

    public function searchResultUrl()
    {
        return '/p/' . $this->page->chapter->category->slug . '/' . $this->page->chapter->slug . '/' . $this->page->slug;
    }

    public function searchResultIcon()
    {
        return '<i class="fa fa-file-o"></i>';
    }
}
