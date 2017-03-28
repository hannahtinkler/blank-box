<?php

namespace App\Http\Controllers;

use Event;

use Illuminate\Http\Request;
use League\CommonMark\CommonMarkConverter;

use App\Events\PageWasAdded;

use App\Http\Requests\PageRequest;

use App\Services\TagService;
use App\Services\PageService;
use App\Services\ChapterService;
use App\Services\CategoryService;
use App\Services\SuggestedEditService;

class PageController extends Controller
{
    /**
     * @var PageService
     */
    private $pages;

    /**
     * @var CategoryService
     */
    private $categories;

    /**
     * @var ChapterService
     */
    private $chapters;

    /**
     * @var SuggestedEditService
     */
    private $suggestedEdits;

    /**
     * @var TagService
     */
    private $tags;

    /**
     * @var CommonMarkConverter
     */
    private $converter;

    /**
     * @param PageService          $pages
     * @param CategoryService      $categories
     * @param ChapterService       $chapters
     * @param SuggestedEditService $suggestedEdits
     * @param TagService           $tags
     * @param CommonMarkConverter  $converter
     */
    public function __construct(
        PageService $pages,
        CategoryService $categories,
        ChapterService $chapters,
        SuggestedEditService $suggestedEdits,
        TagService $tags,
        CommonMarkConverter $converter
    ) {
        $this->pages = $pages;
        $this->categories = $categories;
        $this->chapters = $chapters;
        $this->suggestedEdits = $suggestedEdits;
        $this->tags = $tags;
        $this->converter = $converter;
    }

    /**
     * @param  Request $request
     * @param  string  $categorySlug
     * @param  string  $chapterSlug
     * @param  string  $pageSlug
     * @return View
     */
    public function show(Request $request, $categorySlug, $chapterSlug, $pageSlug)
    {
        $page = $this->pages->getApprovedBySlug($pageSlug);

        $page->content = $this->converter->convertToHtml($page->content);

        return view('pages.show', [
            'page' => $page,
            'user' => $request->user()
        ]);
    }

    /**
     * @param  Request $request
     * @return View
     */
    public function create(Request $request)
    {
        $user = $request->user();
        $tags = $this->tags->getAll();
        $categories = $this->categories->getAll();

        return view('pages.create', compact('categories', 'tags', 'user'));
    }

    /**
     * @param  PageRequest $request
     * @return Redirect
     */
    public function store(PageRequest $request)
    {
        $user = $request->user();
        
        $data = $request->input();
        $data['user_id'] = $user->id;
        $data['approved'] = $this->pages->shouldBeApproved($user, $data);

        $page = $this->pages->store($data);

        if (isset($data['last_draft_id']) && !empty($data['last_draft_id'])) {
            $this->drafts->delete($data['last_draft_id']);
        }

        if ($page->approved) {
            Event::fire(new PageWasAdded($page, $user));
        }

        $message = '<i class="fa fa-check"></i> This page has been saved and you\'re now viewing it.';
        
        if (env('FEATURE_CURATION_ENABLED')) {
            $message .= " It will only be added to the chapter after it has been curated.";
        }

        return redirect($page->searchResultUrl())->with('message', $message);
    }

    /**
     * @param  int $id
     * @return View
     */
    public function edit($id)
    {
        $page = $this->pages->getById($id);

        $tags = $this->tags->getAll();
        $categories = $this->categories->getAll();
        $chapters = $this->chapters->getByCategoryId($page->chapter->category_id);

        return view('pages.edit', compact('page', 'categories', 'chapters', 'tags'));
    }

    /**
     * @param  PageRequest $request
     * @param  int      $id
     * @return Redirect
     */
    public function update(PageRequest $request, $id)
    {
        $user = $request->user();
        $page = $this->pages->getById($id);

        $data = $request->input();
        $data['user_id'] = $user->id;
        $data['approved'] = $this->pages->shouldBeApproved($user, $data);

        $this->suggestedEdits->store($page->id, $data);

        if (env('FEATURE_CURATION_ENABLED')) {
            $message = 'Your suggested edit has been submitted. It will now be reviewed and actioned by a curator.';
        } else {
            $page = $this->pages->update($page->id, $data);
            $message = "This page has been edited successfully and you're now viewing it.";
        }

        return redirect($page->searchResultUrl)->with(
            'message',
            sprintf('<i class="fa fa-check"></i>%s', $message)
        );
    }
    
    /**
     * @param  Request $request
     * @param  int  $id
     * @return Redirect
     */
    public function destroy(Request $request, $id)
    {
        $page = $this->pages->getById($id);
        
        $page->delete();

        return redirect($page->chapter->searchResultUrl())->with(
            'message',
            '<i class="fa fa-check"></i> This page has been successfully deleted'
        );
    }
}
