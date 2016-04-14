<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Library\Models\Chapter;
use App\Library\Models\Page;
use App\Library\Models\Bookmark;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarks = Bookmark::orderBy('created_at', 'DESC')->get();
        return view('bookmarks.index', compact('bookmarks'));
    }

    public function create($chapterId, $pageId = null)
    {
        $chapter = Chapter::where('id', $chapterId)->first();
        $page = Page::where('id', $pageId)->first();

        if (!is_object($chapter) || (!is_object($page) && $pageId != null)) {
            throw new \Exception("Invalid data received");
        }

        $exists = Bookmark::where('chapter_id', $chapter->id)
            ->where('page_id', is_object($page) ? $page->id : null)
            ->get();

        if ($exists->isEmpty()) {
            $exists = Bookmark::create([
                'chapter_id' => $chapter->id,
                'page_id' => is_object($page) ? $page->id : null
            ]);
        }

        return json_encode([
            'success' => true,
            'entity' =>  $exists,
            'count' => Bookmark::all()->count()
        ]);
    }

    public function delete($chapterId, $pageId = null)
    {
        $chapter = Chapter::where('id', $chapterId)->first();
        $page = Page::where('id', $pageId)->first();

        if (!is_object($chapter) || (!is_object($page) && $pageId != null)) {
            throw Exception("Invalid data received");
        }

        $exists = Bookmark::where('chapter_id', $chapter->id)
            ->where('page_id', is_object($page) ? $page->id : null)
            ->first();

        if (is_object($exists)) {
            $exists->delete();
        }

        return json_encode([
            'success' => true,
            'message' =>  'Bookmark has been removed',
            'count' => Bookmark::all()->count()
        ]);
    }
}
