<?php

namespace App\Services\ControllerServices;

use Illuminate\Http\Request;

use App\Models\PageDraft;

class PageDraftControllerService
{
    public $user;

    public function __construct(Request $request)
    {
        $this->user = $request->user();
    }

    public function savePageDraft($data)
    {
        $draft = PageDraft::create([
            'chapter_id' => isset($data['chapter_id']) ? $data['chapter_id'] : null,
            'title' => isset($data['title']) ? $data['title'] : null,
            'description' => isset($data['description']) ? $data['description'] : null,
            'content' => isset($data['content']) ? encodeFromCkEditor($data['content']) : null,
            'created_by' => $this->user->id,
        ]);

        return $draft;
    }

    public function updatePageDraft($draft, $data)
    {
        $draft->chapter_id = isset($data['chapter_id']) ? $data['chapter_id'] : null;
        $draft->title = isset($data['title']) ? $data['title'] : null;
        $draft->description = isset($data['description']) ? $data['description'] : null;
        $draft->content = isset($data['content']) ? encodeFromCkEditor($data['content']) : null;
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

    public function getDraftsForUser()
    {
        $drafts = PageDraft::where('created_by', $this->user->id)
            ->where('approved', null)
            ->get();

        return $drafts;
    }
}
