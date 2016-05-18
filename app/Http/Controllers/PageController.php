<?php

namespace App\Http\Controllers;

use App\Services\ControllerServices\PageControllerService;
use App\Http\Requests\PageRequest;
use App\Services\ModelServices\PageModelService;

use App\Models\Category;
use App\Models\Chapter;
use App\Models\Page;

class PageController extends Controller
{
    private $controllerService;

    public function __construct(PageControllerService $controllerService)
    {
        $this->controllerService = $controllerService;
    }
    
    public function show($categorySlug, $chapterSlug, $pageSlug)
    {
        $page = Page::findBySlug($pageSlug);

        return view('pages.show', [
            'page' => $page,
            'user' => $this->controllerService->user
        ]);
    }
    
    public function create()
    {
        $categories = Category::orderBy('title')->get();
        $chapters = Chapter::orderBy('title')->get();

        return view('pages.create', compact('categories', 'chapters'));
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $user = $this->controllerService->user;
        
        $editable = $page->editableByUser();

        $categories = Category::orderBy('title')->get();
        $chapters = Chapter::where('category_id', $page->chapter->category_id)->orderBy('title')->get();

        return view('pages.edit', compact('page', 'categories', 'chapters', 'editable'));
    }

    public function update(PageRequest $request, $id)
    {
        $page = Page::findOrFail($id);
        
        if ($page->editableByUser()) {
            $this->controllerService->updatePage($page, $request->input());
            $message = 'This page has been edited successfully and you\'re now viewing it. Only you will be able to see it until it has been curated.';
        } else {
            $this->controllerService->storeSuggestedEdit($page, $request->input());
            $message = 'Your suggested edit has been submitted. It will now be reviewed and actioned by a curator.';
        }


        return redirect($page->searchResultUrl())->with(
            'message',
            '<i class="fa fa-check"></i>  ' . $message
        );
    }

    public function store(PageRequest $request)
    {
        $page = $this->controllerService->storePage($request->input());
        return redirect($page->searchResultUrl())->with('message', '<i class="fa fa-check"></i> This page has been saved and you\'re now viewing it. Only you will be able to see it until it has been curated.');
    }
    
    public function destroy($id)
    {
        if ($this->controllerService->user->curator) {
            $page = Page::find($id);
            $page->delete();

            return redirect('/p/' . $page->chapter->category->slug . '/' . $page->chapter->slug)
            ->with('message', 'Page has been successfully deleted');
        } else {
            return \App::abort(401);
        }
    }
    
    public function getLatestPages()
    {
        $updatedPages = Page::latestUpdated()->paginate(10);
        return view('updated-pages.index', compact('updatedPages'));
    }
}
