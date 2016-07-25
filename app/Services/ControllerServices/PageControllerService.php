<?php

namespace App\Services\ControllerServices;

use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\PageDraft;
use App\Models\SuggestedEdit;
use App\Services\ControllerServices\PageDraftControllerService;

class PageControllerService
{
    public $user;

    public function __construct(Request $request, PageDraftControllerService $draftControllerService)
    {
        $this->user = $request->user();
        $this->draftControllerService = $draftControllerService;
    }

    public function storePage($data)
    {
        if (isset($data['last_draft_id']) && !empty($data['last_draft_id'])) {
            $this->draftControllerService->deletePageDraft($data['last_draft_id']);
        }

        $nextPageOrderValue = $this->getNextPageOrderValue($data['chapter_id']);

        $page = Page::create([
            'chapter_id' => $data['chapter_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
            'created_by' => $this->user->id,
            'slug' => str_slug($data['title']),
            'order' => $nextPageOrderValue,
            'approved' => (int) isset($data['approved']) ? 1 : null
        ]);

        return $page;
    }

    public function storeSuggestedEdit($page, $data, $approved = null)
    {
        $page = SuggestedEdit::create([
            'page_id' => $page->id,
            'chapter_id' => $data['chapter_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
            'created_by' => $this->user->id,
            'approved' => $approved ? true : null
        ]);

        return $page;
    }

    public function updatePage($page, $data)
    {
        $page->chapter_id = $data['chapter_id'];
        $page->title = $data['title'];
        $page->description = $data['description'];
        $page->content = $data['content'];
        $page->slug = str_slug($data['title']);
        $page->approved = (int) isset($data['approved']) ? 1 : $page->approved;
        $page->save();

        if (isset($data['last_draft_id']) && !empty($data['last_draft_id'])) {
            $this->draftControllerService->deletePageDraft($data['last_draft_id']);
        }

        return $page;
    }

    public function getNextPageOrderValue($chapterId)
    {
        $currentOrderValue = Page::where('chapter_id', $chapterId)->orderBy('order', 'desc')->first();
        
        return is_object($currentOrderValue) ? $currentOrderValue->order + 1 : 1;
    }
}
