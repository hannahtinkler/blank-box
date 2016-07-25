<?php

namespace App\Services\ControllerServices;

use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\SuggestedEdit;

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
        $page = Page::findOrFail($edit->page_id);

        $this->pageControllerService->updatePage($page, [
            'chapter_id' => $edit->chapter_id,
            'title' => $edit->title,
            'description' => $edit->description,
            'content' => $edit->content,
            'approved' => 1
        ]);


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
    }

    public function rejectNewPage($id)
    {
        $page = Page::find($id);
        $page->approved = 0;
        $page->save();
    }
}
