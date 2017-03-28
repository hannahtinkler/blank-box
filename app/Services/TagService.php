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
     * @param  int $pageId
     * @param  array $tags
     * @return void
     */
    public function store($pageId, $tags)
    {
        PageTag::where('page_id', $pageId)->delete();

        foreach ($tags as $tag) {
            $tag = Tag::firstOrCreate([
                'tag' => $tag
            ]);

            PageTag::create([
                'tag_id' => $tag->id,
                'page_id' => $pageId,
            ]);
        }
    }
}
