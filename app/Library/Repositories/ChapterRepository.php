<?php

namespace App\Library\Repositories;

use App\Library\Interfaces\SearchableRepository;
use App\Library\Models\Chapter;

class ChapterRepository implements SearchableRepository
{
    public function getSearchResults($term)
    {
        return Chapter::searchByQuery([
            "wildcard" => ['_all' => "*" . $term . "*"]
        ]);
    }

    public function searchResultString($result)
    {
        return 'Chapter: ' . $result->title . ' - ' . substr($result->description, 1, 60) . '...';
    }

    public function searchResultUrl($result)
    {
        return '/p/' . $result->category->slug . '/' . $result->slug;
    }
}
