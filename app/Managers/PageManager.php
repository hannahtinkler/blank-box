<?php

namespace App\Managers;

use Auth;
use App\Models\Page;
use App\Models\PageDraft;

class PageManager
{
    public $user;

    public function __construct($user = null)
    {
        $this->user = $user ?: Auth::user();
    }

    public function savePage($data)
    {
        if (isset($data['last_draft_id']) && !empty($data['last_draft_id'])) {
            $this->deletePageDraft($data['last_draft_id']);
        }

        $currentOrderValue = Page::where('chapter_id', $data['chapter_id'])->orderBy('order', 'desc')->first();
        $nextOrderValue = is_object($currentOrderValue) ? $currentOrderValue->order + 1 : 1;

        $data['created_by'] = $this->user->id;
        $data['slug'] = str_slug($data['title']);
        $data['order'] = $nextOrderValue;
        $data['approved'] = (int) isset($data['approved']) ? 1 : 0;

        $page = Page::create(array_except(
            $data,
            ['last_draft_id']
        ));

        $page->addToIndex();

        return $page;
    }

    public function updatePage($page, $data)
    {
        if (isset($data['last_draft_id']) && !empty($data['last_draft_id'])) {
            $this->deletePageDraft($data['last_draft_id']);
        }

        $data['slug'] = str_slug($data['title']);

        $page->update(array_except(
            $data,
            ['last_draft_id']
        ));

        return $page;
    }

    public function savePageDraft($data)
    {
        $data['created_by'] = $this->user->id;

        $draft = PageDraft::create(array_except(
            $data,
            ['last_draft_id']
        ));

        return $draft;
    }

    public function updatePageDraft($draft, $data)
    {
        $draft->update(array_except(
            $data,
            ['last_draft_id']
        ));
        return $draft;
    }

    public function deletePageDraft($id)
    {
        $currentDraft = PageDraft::find($id);
        if ($currentDraft) {
            $currentDraft->delete();
        }
    }
}
