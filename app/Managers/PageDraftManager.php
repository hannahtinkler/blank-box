<?php

namespace App\Managers;

use Auth;
use App\Models\PageDraft;

class PageDraftManager
{
    public $user;

    public function __construct($user = null)
    {
        $this->user = $user ?: Auth::user();
    }

    public function savePageDraft($data)
    {
        $draft = PageDraft::create([
            'chapter_id' => isset($data['chapter_id']) ? $data['chapter_id'] : null,
            'title' => isset($data['title']) ? $data['title'] : null,
            'description' => isset($data['description']) ? $data['description'] : null,
            'content' => isset($data['content']) ? $data['content'] : null,
            'created_by' => $this->user->id,
        ]);

        return $draft;
    }

    public function updatePageDraft($draft, $data)
    {
        $draft->chapter_id = isset($data['chapter_id']) ? $data['chapter_id'] : null;
        $draft->title = isset($data['title']) ? $data['title'] : null;
        $draft->description = isset($data['description']) ? $data['description'] : null;
        $draft->content = isset($data['content']) ? $data['content'] : null;
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
}
