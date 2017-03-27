<?php

namespace App\Services;

use App\Models\SuggestedEdit;

class SuggestedEditService
{
    /**
     * @return SuggestedEdit
     */
    public function getById()
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
     * @param  int $pageId
     * @param  array $data
     * @return SuggestedEdit
     */
    public function store($pageId, array $data)
    {
        return SuggestedEdit::create([
            'page_id' => $pageId,
            'chapter_id' => $data['chapter_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
            'created_by' => $data['user_id'],
            'approved' => $data['approved'],
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
