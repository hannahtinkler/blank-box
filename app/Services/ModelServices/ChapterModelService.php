<?php

namespace App\Services\ModelServices;

use Illuminate\Http\Request;

use App\Models\Chapter;
use App\Interfaces\SearchableModelService;

class ChapterModelService implements SearchableModelService
{
    public $chapter;

    public function __construct($chapter)
    {
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

        return Chapter::searchByQuery($query, null, null, 100);
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
