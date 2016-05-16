<?php

namespace App\Http\Controllers;

use App\Managers\PageManager;
use App\Http\Requests\PageRequest;
use App\Repositories\PageRepository;

use App\Models\Category;
use App\Models\Chapter;
use App\Models\Page;
use App\Models\PageDraft;

class PageController extends Controller
{
    private $manager;
    private $repository;

    public function __construct(PageManager $manager)
    {
        $this->manager = $manager;
    }
    
    public function show($categorySlug, $chapterSlug, $pageSlug)
    {
        $page = Page::findBySlug($pageSlug);

        return view('pages.show', [
            'page' => $page,
            'user' => $this->manager->user
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
        $user = $this->manager->user;
        
        if (!$page->editableByMe()) {
            return \App::abort(401);
        }

        $categories = Category::orderBy('title')->get();
        $chapters = Chapter::where('category_id', $page->chapter->category_id)->orderBy('title')->get();

        return view('pages.edit', compact('page', 'categories', 'chapters'));
    }

    public function update(PageRequest $request, $id)
    {
        $page = Page::findOrFail($id);
        
        if (!$page->editableByMe()) {
            return \App::abort(401);
        }

        $this->manager->updatePage($page, $request->input());

        return redirect($page->showRedirectUrl())->with(
            'message',
            '<i class="fa fa-check"></i> This page has been edited successfully and you\'re now viewing it. Only you will be able to see it until it has been curated.'
        );
    }

    public function savePageDraft(PageRequest $request, $id = null)
    {
        if ($id != null) {
            $draft = PageDraft::find($id);
            $draft = $this->manager->updatePageDraft($draft, $request->input());
            $draft->updated_at_formatted = $draft->updated_at->format('jS F Y H:i:sa');
        } else {
            $draft = $this->manager->savePageDraft($request->input());
            $draft->updated_at_formatted = $draft->created_at->format('jS F Y H:i:sa');
        }

        return json_encode([
            'draft' => $draft,
            'success' => true
        ]);
    }

    public function store(PageRequest $request)
    {
        $page = $this->manager->savePage($request->input());
        return redirect($page->showRedirectUrl())->with('message', '<i class="fa fa-check"></i> This page has been saved and you\'re now viewing it. Only you will be able to see it until it has been curated.');
    }
    
    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();

        return redirect('/p/' . $page->chapter->category->slug . '/' . $page->chapter->slug)
        ->with('message', 'Page has been successfully deleted');
    }
    
    public function getLatestPages()
    {
        $updatedPages = Page::latestUpdated()->paginate(10);
        return view('updated-pages.index', compact('updatedPages'));
    }
}
