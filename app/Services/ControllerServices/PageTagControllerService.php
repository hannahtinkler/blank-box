<?php

namespace App\Services\ControllerServices;

use Illuminate\Http\Request;

use App\Models\Tag;
use App\Models\PageTag;

class PageTagControllerService
{
    public $user;

    public function __construct(Request $request)
    {
        $this->user = $request->user();
    }

    public function storeTagsForAPage($page, $tags)
    {
        $tagIds = $this->storeTagsThatDontExistAndReturnTagIds($tags);

        $this->storeMultipleAddedPageTags($page->id, $tagIds);
        $this->removeDeletedPageTags($page->id, $tagIds);
    }

    public function storeTagsThatDontExistAndReturnTagIds($tags)
    {
        $tagIds = [];
        foreach ($tags as $tag) {
            $check = Tag::where('tag', $tag)->first();

            if (!is_object($check)) {
                $check = $this->storeANewTag($tag);
            }

            $tagIds[] = $check->id;
        }

        return $tagIds;
    }

    public function storeANewTag($tag)
    {
        return Tag::create([
            'tag' => $tag
        ]);
    }

    public function removeDeletedPageTags($pageId, $tagIds)
    {
        $existingTags = PageTag::where('page_id', $pageId)->get();

        foreach ($existingTags as $existingTag) {
            if (!in_array($existingTag->tag_id, $tagIds)) {
                $existingTag->delete();
            }
        }
    }

    public function storeMultipleAddedPageTags($pageId, $tagIds)
    {
        foreach ($tagIds as $tagId) {
            $check = PageTag::where('tag_id', $tagId)
                ->where('page_id', $pageId)
                ->first();

            if (!is_object($check)) {
                $check = $this->storeANewPageTag($pageId, $tagId);
            }
        }
    }

    public function storeANewPageTag($pageId, $tagId)
    {
        return PageTag::create([
                'tag_id' => $tagId,
                'page_id' => $pageId
            ]);
    }
}
