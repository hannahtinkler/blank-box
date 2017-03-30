<?php

namespace App\Services;

use App\Models\PageDraft;

class PageDraftService
{
    /**
     * @param  int $int
     * @return PageDraft
     */
    public function getById($id)
    {
        return PageDraft::findOrFail($id);
    }

    /**
     * @param  int $userId
     * @return Collection
     */
    public function getAllByUserId($userId)
    {
        return PageDraft::where('created_by', $userId)
            ->where('approved', null)
            ->get();
    }

    /**
     * @param  array  $data
     * @return PageDraft
     */
    public function store($userId, array $data)
    {
        return PageDraft::create([
            'chapter_id' => isset($data['chapter_id']) ? $data['chapter_id'] : null,
            'title' => isset($data['title']) ? $data['title'] : null,
            'description' => isset($data['description']) ? $data['description'] : null,
            'content' => isset($data['content']) ? $data['content'] : null,
            'created_by' => $userId,
        ]);
    }

    /**
     * @param  int $id
     * @param  array $data
     * @return PageDraft
     */
    public function update($id, array $data)
    {
        $draft = $this->getById($id);

        $draft->chapter_id = isset($data['chapter_id']) ? $data['chapter_id'] : null;
        $draft->title = isset($data['title']) ? $data['title'] : null;
        $draft->description = isset($data['description']) ? $data['description'] : null;
        $draft->content = isset($data['content']) ? $data['content'] : null;

        $draft->save();

        return $draft;
    }

    /**
     * @param  int $id
     * @return boolean
     */
    public function delete($id)
    {
        return PageDraft::where('id', $id)->delete();
    }
}
