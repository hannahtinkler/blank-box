<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\PageTag;

class TagService
{
    /**
     * @return Collection
     */
    public function getAll()
    {
        return Tag::orderBy('tag')->get();
    }

    /**
     * Delete all tags for page, then create missing tags and add them for the
     * page.
     *
     * @param  Page $page
     * @param  array $tags
     * @return void
     */
    public function store($page, $tags)
    {
        PageTag::where('page_id', $page->id)->delete();

        foreach ($tags as $tag) {
            $tag = Tag::firstOrCreate([
                'tag' => $tag
            ]);

            PageTag::create([
                'tag_id' => $tag->id,
                'page_id' => $page->id,
            ]);
        }
    }
}
