<?php

namespace App\Library\Repositories;

use App\Library\Interfaces\Searchable;
use App\Library\Models\Chapter;

class ChapterRepository implements Searchable
{
    public function getSearchResults($term)
    {
        $chapters = Chapter::select([
                \DB::raw("CONCAT('Chapter: ', chapters.title, ' - ', SUBSTR(chapters.description, 1, 60), '...') as content"),
                \DB::raw("CONCAT('/p/', categories.slug, '/', chapters.slug) as url")
            ])
            ->join('categories', 'chapters.category_id', '=', 'categories.id')
            ->where('chapters.title', 'LIKE', '%' . $term .'%')
            ->orWhere('chapters.description', 'LIKE', '%' . $term .'%')
            ->orWhere('chapters.slug', 'LIKE', '%' . $term .'%')
            ->get()
            ->toArray();

        return $chapters;
    }
}
