<?php

namespace App\Library\Repositories;

use App\Library\Interfaces\Searchable;
use App\Library\Models\Page;

class PageRepository implements Searchable
{
    public function getSearchResults($term)
    {
        $pages = Page::select([
                \DB::raw("CONCAT('Page: ', pages.title) as content"),
                \DB::raw("CONCAT('/chapter/', chapters.slug, '/', pages.slug) as url")
            ])
            ->join('chapters', 'pages.chapter_id', '=', 'chapters.id')
            ->where('pages.title', 'LIKE', '%' . $term .'%')
            ->orWhere('pages.content', 'LIKE', '%' . $term .'%')
            ->orWhere('pages.slug', 'LIKE', '%' . $term .'%')
            ->get()
            ->toArray();

        return $pages;
    }
}
