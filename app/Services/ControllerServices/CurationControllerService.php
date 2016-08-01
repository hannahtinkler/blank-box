<?php

namespace App\Services\ControllerServices;

use Illuminate\Http\Request;

use cogpowered\FineDiff\Diff;

use App\Events\PageWasAddedToChapter;

use App\Models\Page;
use App\Models\SuggestedEdit;

use App\Services\ControllerServices\PageControllerService;

class CurationControllerService
{
    public $user;

    public function __construct(Request $request, PageControllerService $pageControllerService)
    {
        $this->user = $request->user();
        $this->pageControllerService = $pageControllerService;
    }

    public function approveSuggestedEdit($id)
    {
        $edit = SuggestedEdit::findOrFail($id);
        $oldPage = Page::findOrFail($edit->page_id);

        $newPage = $this->pageControllerService->updatePage($oldPage, [
            'chapter_id' => $edit->chapter_id,
            'title' => $edit->title,
            'description' => $edit->description,
            'content' => $edit->content,
            'approved' => 1
        ]);

        if ($oldPage->slug != $newPage->slug) {
            $this->pageControllerService->registerSlugForwarding($oldPage, $newPage);
        }

        $edit->approved = true;
        $edit->save();

        return $edit;
    }

    public function rejectSuggestedEdit($id)
    {
        $edit = SuggestedEdit::find($id);
        $edit->approved = false;
        $edit->save();
    }

    public function approveNewPage($id)
    {
        $page = Page::find($id);
        $page->approved = 1;
        $page->save();
        
        \Event::fire(new PageWasAddedToChapter($page));

    }

    public function rejectNewPage($id)
    {
        $page = Page::find($id);
        $page->approved = 0;
        $page->save();
    }

    public function getPageDiff($original, $new)
    {
        $differ = new Diff;

        $diff = [
            'category' => $differ->render($original->chapter->title, $new->chapter->title),
            'chapter' => $differ->render($original->chapter->category->title, $new->chapter->category->title),
            'title' => $differ->render($original->title, $new->title),
            'description' => $differ->render($original->description, $new->description),
            'content' => $differ->render($original->content, $new->content)
        ];

        return $diff;
    }
}
