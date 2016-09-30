<?php

namespace App\Services\ControllerServices;

use Illuminate\Http\Request;

use App\Events\PageWasAddedToChapter;

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
            'content' => encodeFromCkEditor($data['content']),
            'created_by' => $this->user->id,
            'slug' => str_slug($data['title']),
            'order' => $nextPageOrderValue,
            'approved' => $this->shouldBeApproved($data)
        ]);

        if (isset($data['tags'])) {
            $this->pageTagControllerService->storeTagsForAPage($page, $data['tags']);
        }

        if ($page->approved) {
            \Event::fire(new PageWasAddedToChapter($page, $page->creator));
        }

        return $page;
    }

    public function storeSuggestedEdit($page, $data, $approved = null)
    {
        $page = SuggestedEdit::create([
            'page_id' => $page->id,
            'chapter_id' => $data['chapter_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => encodeFromCkEditor($data['content']),
            'created_by' => $this->user->id,
            'approved' => $this->shouldBeApproved($approved)
        ]);

        return $page;
    }

    public function updatePage($page, $data)
    {
        $oldPage = clone $page;

        $page->chapter_id = $data['chapter_id'];
        $page->title = $data['title'];
        $page->description = $data['description'];
        $page->content = encodeFromCkEditor($data['content']);
        $page->slug = str_slug($data['title']);
        $page->approved = $this->shouldBeApproved($data, $page);
        $page->save();

        if (isset($data['last_draft_id']) && !empty($data['last_draft_id'])) {
            $this->draftControllerService->deletePageDraft($data['last_draft_id']);
        }

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

    public function retrieveSlugForwardingSetting($pageSlug)
    {
        return Page::leftJoin('slug_forwarding_settings', 'pages.slug', '=', 'slug_forwarding_settings.new_slug')
            ->where('old_slug', $pageSlug)
            ->firstOrFail();
    }

    public function shouldBeApproved($incomingData, $currentPage = null)
    {
        if (!env('FEATURE_CURATION_ENABLED')) {
            // If curation is turned off, return true (already approved)
            return 1;
        } else if (isset($incomingData['approved'])) {
            // If new data specifies approved, listen
            return 1;
        } else if ($currentPage != null) {
            // If no other data available but it was already approved, go
            return $currentPage->approved;
        }

        return null;
    }

    public function registerSlugForwarding($oldPage, $newPage)
    {
        SlugForwardingSetting::where('new_slug', $oldPage->slug)->update(['new_slug' => $newPage->slug]);

        return SlugForwardingSetting::create([
            'old_slug' => $oldPage->slug,
            'new_slug' => $newPage->slug
        ]);
    }
}
