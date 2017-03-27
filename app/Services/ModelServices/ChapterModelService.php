<?php

namespace App\Services\ModelServices;

use Illuminate\Http\Request;

use App\Models\Chapter;
use App\Interfaces\SearchableModelService;

class ChapterModelService
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
}
