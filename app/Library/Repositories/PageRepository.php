<?php

namespace App\Library\Repositories;

use App\Library\Interfaces\SearchableRepository;
use App\Library\Models\Page;

class PageRepository implements SearchableRepository
{
    public function getSearchResults($term)
    {
        return Page::searchByQuery([
            "wildcard" => ['_all' => "*" . $term . "*"]
        ]);
    }

    public function searchResultString($result)
    {
        return 'Page: ' . $result->title;
    }

    public function searchResultUrl($result)
    {
        return '/p/' . $result->chapter->category->slug . '/' . $result->chapter->slug . '/' . $result->slug;
    }
}
