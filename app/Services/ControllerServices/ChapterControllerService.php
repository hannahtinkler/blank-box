<?php

namespace App\Services\ControllerServices;

use Auth;
use App\Models\Chapter;

class ChapterControllerService
{
    public $user;

    public function __construct($user = null)
    {
        $this->user = $user ?: Auth::user();
    }

    public function storeChapter($data)
    {
        $nextChapterOrderValue = $this->getNextChapterOrderValue($data['category_id']);

        $chapter = Chapter::create([
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'slug' => str_slug($data['title']),
            'order' => $nextChapterOrderValue,
        ]);

        return $chapter;
    }

    public function updateChapter($chapter, $data)
    {
        $chapter->category_id = $data['category_id'];
        $chapter->title = $data['title'];
        $chapter->description = $data['description'];
        $chapter->slug = str_slug($data['title']);
        $chapter->save();

        return $chapter;
    }

    public function getNextChapterOrderValue($categoryId)
    {
        $currentOrderValue = Chapter::where('category_id', $categoryId)->orderBy('order', 'desc')->first();
        
        return is_object($currentOrderValue) ? $currentOrderValue->order + 1 : 1;
    }
}
