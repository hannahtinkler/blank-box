<?php

namespace App\Library\Repositories;

use App\Library\Interfaces\Searchable;
use App\Library\Models\Chapter;

class ChapterRepository implements Searchable
{
    public function getSearchResults($term)
    {
        $chapters = Chapter::select([
                \DB::raw("CONCAT('Chapter: ', chapters.title, ' - ', SUBSTR(chapters.description, 0, 20)) as content"),
                \DB::raw("CONCAT('/chapter/', chapters.slug) as url")
            ])
            ->where('title', 'LIKE', '%' . $term .'%')
            ->orWhere('description', 'LIKE', '%' . $term .'%')
            ->orWhere('slug', 'LIKE', '%' . $term .'%')
            ->get()
            ->toArray();

        return $chapters;
    }
}
