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
            'chapter_id' => $data['chapter_id'] ?? null,
            'title' => $data['title'] ?? null,
            'description' => $data['description'] ?? null,
            'content' => $data['content'] ?? null,
            'created_by' => $this->user->id,
        ]);

        return $draft;
    }

    public function updatePageDraft($draft, $data)
    {
        $draft->chapter_id = $data['chapter_id'] ?? null;
        $draft->title = $data['title'] ?? null;
        $draft->description = $data['description'] ?? null;
        $draft->content = $data['content'] ?? null;
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
