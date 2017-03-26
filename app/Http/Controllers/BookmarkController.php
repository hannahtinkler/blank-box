<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\UserService;
use App\Services\BookmarkService;

class BookmarkController extends Controller
{
    /**
     * @var BookmarkService
     */
    private $user;

    /**
     * @var UserService
     */
    private $bookmarks;

    /**
     * @param BookmarkService $bookmarks
     * @param UserService     $users
     */
    public function __construct(BookmarkService $bookmarks, UserService $users)
    {
        $this->bookmarks = $bookmarks;
        $this->users = $users;
    }

    /**
     * @param  Request $request
     * @param  string  $userSlug
     * @return View
     */
    public function index(Request $request, $userSlug)
    {
        $bookmarks = $this->bookmarks->getByUserSlug($userSlug);

        return view('bookmarks.index', compact('bookmarks'));
    }

    /**
     * @param  string $userSlug
     * @param  int $categoryId
     * @param  int $chapterId
     * @param  int $pageId
     * @return string
     */
    public function create($userSlug, $categoryId, $chapterId, $pageId = null)
    {
        $user = $this->users->getBySlug($userSlug);
        $bookmark = $this->bookmarks->store($user->id, $chapterId, $pageId);

        return json_encode([
            'success' => true,
            'entity' =>  $bookmark,
            'count' => $this->bookmarks->getByUserSlug($userSlug)->count(),
        ]);
    }

    /**
     * @param  string $userSlug
     * @param  int $categoryId
     * @param  int $chapterId
     * @param  int $pageId
     * @return string
     */
    public function destroy($userSlug, $categoryId, $chapterId, $pageId = null)
    {
        $user = $this->users->getBySlug($userSlug);
        $this->bookmarks->delete($user->id, $chapterId, $pageId);

        return json_encode([
            'success' => true,
            'message' =>  'Bookmark has been removed',
            'count' => $this->bookmarks->getByUserSlug($userSlug)->count(),
        ]);
    }
}
