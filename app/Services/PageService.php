<?php

namespace App\Services;

use App\Models\Page;
use App\Traits\Sluggable;

class PageService
{
    use Sluggable;

    /**
     * @param  int $id
     * @return Page
     */
    public function getById($id)
    {
        return Page::findOrFail($id);
    }
    
    /**
     * @param  int $userId
     * @return Page
     */
    public function getApprovedByUserId($userId)
    {
        return Page::where('created_by', $userId)
            ->where('approved', 1)
            ->get();
    }

    /**
     * @return Page
     */
    public function getAllUnapproved()
    {
        return Page::where('approved', null)->get();
    }

    /**
     * @return Page
     */
    public function getRandom()
    {
        return Page::where('approved', 1)->orderByRaw("RAND()")->first();
    }

    /**
     * @param  int $id
     * @param  array  $data
     * @return Page
     */
    public function update($id, array $data)
    {
        $page = $this->getById($id);

        if ($page->title != $data['title']) {
            $page->slug = $this->getSlug(Page::class, $data['title']);
        }
        
        $page->chapter_id = $data['chapter_id'];
        $page->title = $data['title'];
        $page->description = $data['description'];
        $page->content = $data['content'];
        $page->approved = $this->shouldBeApproved($data, $page);

        $page->save();

        return $page;
    }

    /**
     * @param  int $id
     * @return void
     */
    public function approve($id)
    {
        $page = Page::find($id);
        $page->approved = 1;
        $page->save();
    }

    /**
     * @param  int $id
     * @return void
     */
    public function reject($id)
    {
        $page = Page::find($id);
        $page->approved = 0;
        $page->save();
    }

    /**
     * If curation is turned off, doesn't need approving so return 1. If
     * new data specifies it should be approved, use this value. If no other
     * data available use the old value.
     *
     * @param  array        $data
     * @param  Page|null    $currentPage
     * @return int |null
     */
    public function shouldBeApproved(array $data, $currentPage = null)
    {
        if (!env('FEATURE_CURATION_ENABLED')) {
            $approved = 1;
        } else if (isset($data['approved']) && $data['approved']) {
            $approved = 1;
        } else if ($currentPage != null) {
            $approved = $currentPage->approved;
        } else {
            $approved = null;
        }

        return $approved;
    }
}
