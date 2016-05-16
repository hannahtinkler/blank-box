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

        $nextPageOrderValue = $this->getNextPageOrderValue($data['chapter_id']);

        $page = Page::create([
            'chapter_id' => $data['chapter_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
            'created_by' => $this->user->id,
            'slug' => str_slug($data['title']),
            'order' => $nextPageOrderValue,
            'approved' => (int) isset($data['approved']) ? 1 : 0
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
            $this->deletePageDraft($data['last_draft_id']);
        }

        return $page;
    }

    public function savePageDraft($data)
    {
        $draft = PageDraft::create([
            'chapter_id' => $data['chapter_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
            'created_by' => $this->user->id,
        ]);

        return $draft;
    }

    public function updatePageDraft($draft, $data)
    {
        $draft->chapter_id = $data['chapter_id'];
        $draft->title = $data['title'];
        $draft->description = $data['description'];
        $draft->content = $data['content'];
        $draft->save();
        
        return $draft;
    }

    public function deletePageDraft($id)
    {
        $currentDraft = PageDraft::find($id);
        if ($currentDraft) {
            $currentDraft->delete();
        }
    }

    public function getNextPageOrderValue($chapterId)
    {
        $currentOrderValue = Page::where('chapter_id', $chapterId)->orderBy('order', 'desc')->first();
        
        return is_object($currentOrderValue) ? $currentOrderValue->order + 1 : 1;
    }
}
