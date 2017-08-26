<?php

namespace App\Services;

use App\Models\SuggestedEdit;

class SuggestedEditService
{
    /**
     * @param  int $id
     * @return SuggestedEdit
     */
    public function getById($id)
    {
        return SuggestedEdit::find($id);
    }

    /**
     * @return Collection
     */
    public function getAllUnapproved()
    {
        return SuggestedEdit::where('approved', null)->get();
    }
    
    /**
     * @param  int $userId
     * @return Page
     */
    public function getApprovedByUserId($userId)
    {
        return SuggestedEdit::where('created_by', $userId)
            ->where('approved', 1)
            ->get();
    }

    /**
     * @param  int $pageId
     * @param  array $data
     * @return SuggestedEdit
     */
    public function store($pageId, array $data)
    {
        $tags = isset($data['tags']) ? implode(',', $data['tags']) : null;

        return SuggestedEdit::create([
            'page_id' => $pageId,
            'chapter_id' => $data['chapter_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
            'created_by' => $data['user_id'],
            'approved' => $data['approved'],
            'tags' => $tags,
        ]);
    }

    /**
     * @param  int $id
     * @return void
     */
    public function approve($id)
    {
        $edit = SuggestedEdit::findOrFail($id);
        $edit->approved = true;
        $edit->save();
    }

    /**
     * @param  int $id
     * @return void
     */
    public function reject($id)
    {
        $edit = SuggestedEdit::findOrFail($id);
        $edit->approved = false;
        $edit->save();
    }
}
