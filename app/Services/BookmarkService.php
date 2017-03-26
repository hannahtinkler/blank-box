<?php

namespace App\Services;

use App\Models\Page;
use App\Models\Chapter;
use App\Models\Bookmark;

class BookmarkService
{
    /**
     * @param  string $slug
     * @return Bookmark
     */
    public function getByUserSlug($slug)
    {
        return Bookmark::select('bookmarks.*')
            ->join('users', 'bookmarks.user_id', '=', 'users.id')
            ->where('users.slug', $slug)
            ->orderBy('bookmarks.created_at', 'DESC')
            ->get();
    }

    /**
     * @param  int $userId
     * @param  int $chapterId
     * @param  int $pageId
     * @return Bookmark
     */
    public function getByIds($userId, $chapterId, $pageId = null)
    {
        return Bookmark::where('chapter_id', $chapterId)
            ->where('user_id', $userId)
            ->where('page_id', $pageId)
            ->where('user_id', $userId)
            ->first();
    }

    /**
     * @param  int $userId
     * @param  int $chapterId
     * @param  int $pageId
     * @return Bookmark
     */
    public function store($userId, $chapterId, $pageId = null)
    {
        $chapter = Chapter::where('id', $chapterId)->firstOrFail();
        
        if ($pageId) {
            $page = Page::where('id', $pageId)->firstOrFail();
        }

        return Bookmark::firstOrCreate([
            'category_id' => $chapter->category_id,
            'chapter_id' => $chapterId,
            'page_id' => $pageId,
            'user_id' => $userId
        ]);
    }

    /**
     * @param  int $userId
     * @param  int $chapterId
     * @param  int $pageId
     * @return Bookmark
     */
    public function delete($userId, $chapterId, $pageId = null)
    {
        $bookmark = $this->getByIds($userId, $chapterId, $pageId);

        if ($bookmark) {
            $bookmark->delete();
        }
    }
}
