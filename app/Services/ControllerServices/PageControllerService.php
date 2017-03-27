<?php

namespace App\Services\ControllerServices;

use Illuminate\Http\Request;

use App\Events\PageWasAdded;

use App\Models\Page;
use App\Models\PageDraft;
use App\Models\SuggestedEdit;
use App\Models\SlugForwardingSetting;

use App\Services\ControllerServices\PageDraftControllerService;

class PageControllerService
{
    public $user;

    public function __construct(Request $request, PageDraftControllerService $draftControllerService, PageTagControllerService $pageTagControllerService)
    {
        $this->user = $request->user();
        $this->draftControllerService = $draftControllerService;
        $this->pageTagControllerService = $pageTagControllerService;
    }

    public function updatePage($page, $data)
    {
        $oldPage = clone $page;

        if (isset($data['approved']) || $page->approved) {
            $this->registerSlugForwarding($oldPage, $page);
        }

        if (isset($data['tags'])) {
            $this->pageTagControllerService->storeTagsForAPage($page, $data['tags']);
        }

        return $page;
    }

    public function getNextPageOrderValue($chapterId)
    {
        $currentOrderValue = Page::where('chapter_id', $chapterId)->orderBy('order', 'desc')->first();
        
        return is_object($currentOrderValue) ? $currentOrderValue->order + 1 : 1;
    }
}
