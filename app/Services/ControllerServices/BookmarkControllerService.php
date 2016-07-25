<?php

namespace App\Services\ControllerServices;

use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\Chapter;
use App\Models\Bookmark;
use App\Models\Category;

class BookmarkControllerService
{
    public $user;

    public function __construct(Request $request)
    {
        $this->user = $request->user();
    }

    public function getBookmark($categoryId, $chapterId, $pageId = null)
    {
        return Bookmark::where('category_id', $categoryId)
            ->where('chapter_id', $chapterId)
            ->where('user_id', $this->user->id)
            ->where('page_id', $pageId)
            ->where('user_id', $this->user->id)
            ->first();
    }

    public function storeBookmark($categoryId, $chapterId, $pageId = null)
    {
        $category = Category::where('id', $categoryId)->firstOrFail();
        $chapter = Chapter::where('id', $chapterId)->firstOrFail();
        
        if ($pageId != null) {
            $page = Page::where('id', $pageId)->firstOrFail();
        }

        $bookmark = $this->getBookmark($categoryId, $chapterId, $pageId);

        if (!is_object($bookmark)) {
            $bookmark = Bookmark::create([
                'category_id' => $categoryId,
                'chapter_id' => $chapterId,
                'page_id' => $pageId,
                'user_id' => $this->user->id
            ]);
        }

        return $bookmark;
    }

    public function deleteBookmark($categoryId, $chapterId, $pageId = null)
    {
        $bookmark = $this->getBookmark($categoryId, $chapterId, $pageId);

        if (is_object($bookmark)) {
            $bookmark->delete();
        }
    }
}
