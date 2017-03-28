<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\PageService;
use App\Services\FeedEventService;

class HomeController extends Controller
{
    /**
     * @var FeedEventService
     */
    private $feedEvents;

    /**
     * @param FeedEventService $feedEvents
     * @param PageService      $pages
     */
    public function __construct(
        FeedEventService $feedEvents,
        PageService $pages
    ) {
        $this->feedEvents = $feedEvents;
        $this->pages = $pages;
    }

    /**
     * @return View
     */
    public function index()
    {
        $feedEvents = $this->feedEvents->getAllPaginated();

        return view('home.index', compact('feedEvents'));
    }
    
    /**
     * @return Redirect
     */
    public function getRandomPage()
    {
        $page = $this->pages->getRandom();

        return redirect('/p/' . $page->chapter->category->slug . '/' . $page->chapter->slug . '/' . $page->slug);
    }
    
    /**
     * @param  Request $request
     * @param  int  $id
     * @return Redirect
     */
    public function switchCategory(Request $request, $id)
    {
        session()->set('currentCategoryId', $id);

        $user = $request->user();
        $user->default_category_id = $id;
        $user->save();

        return redirect(url()->previous());
    }
}
