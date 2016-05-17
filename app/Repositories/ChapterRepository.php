<?php

namespace App\Repositories;

use Auth;
use App\Interfaces\SearchableRepository;
use App\Models\Chapter;

class ChapterRepository implements SearchableRepository
{
    public $user;
    public $chapter;

    public function __construct($chapter)
    {
        $this->user = Auth::user();
        $this->chapter = $chapter;
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

        return Chapter::searchByQuery($query);
    }

    public function searchResultString()
    {
        return 'Chapter: ' . $this->chapter->title . ' - ' . substr($this->chapter->description, 0, 60) . '...';
    }

    public function searchResultUrl()
    {
        return '/p/' . $this->chapter->category->slug . '/' . $this->chapter->slug;
    }

    public function searchResultIcon()
    {
        return '<i class="fa fa-folder-open-o"></i>';
    }
}
