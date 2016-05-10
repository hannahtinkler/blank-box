<?php

namespace App\Library\Repositories;

use App\Library\Interfaces\SearchableRepository;
use App\Library\Models\Page;

class PageRepository implements SearchableRepository
{
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

    public function searchResultString($result)
    {
        return 'Page: ' . $result->title;
    }

    public function searchResultUrl($result)
    {
        return '/p/' . $result->chapter->category->slug . '/' . $result->chapter->slug . '/' . $result->slug;
    }

    public function searchResultIcon($result)
    {
        return '<i class="fa fa-file-o"></i>';
    }
}
