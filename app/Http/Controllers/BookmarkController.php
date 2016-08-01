<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bookmark;

use App\Services\ControllerServices\BookmarkControllerService;

class BookmarkController extends Controller
{
    private $controllerService;

    public function __construct(BookmarkControllerService $controllerService)
    {
        $this->controllerService = $controllerService;
    }

    public function index(Request $request, $userSlug)
    {
        $bookmarks = Bookmark::join('users', 'bookmarks.user_id', '=', 'users.id')
            ->where('users.slug', $userSlug)
            ->orderBy('bookmarks.created_at', 'DESC')
            ->get();

        return view('bookmarks.index', compact('bookmarks'));
    }

    public function create($userSlug, $categoryId, $chapterId, $pageId = null)
    {
        $bookmark = $this->controllerService->storeBookmark($categoryId, $chapterId, $pageId);

        return json_encode([
            'success' => true,
            'entity' =>  $bookmark,
            'count' => Bookmark::all()->count()
        ]);
    }

    public function destroy($userSlug, $categoryId, $chapterId, $pageId = null)
    {
        $this->controllerService->deleteBookmark($categoryId, $chapterId, $pageId);

        return json_encode([
            'success' => true,
            'message' =>  'Bookmark has been removed',
            'count' => Bookmark::all()->count()
        ]);
    }
}
