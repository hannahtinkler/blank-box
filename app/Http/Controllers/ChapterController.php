<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Chapter;

class ChapterController extends Controller
{
    public function show($categorySlug, $chapterSlug)
    {
        $chapter = Chapter::where('slug', $chapterSlug)->first();

        if (!is_object($chapter)) {
            return \App::abort(404);
        }
        
        return view('chapters.show', compact('chapter'));
    }

    public function getChaptersForCategory($categoryId)
    {
        $chapters = Chapter::where('category_id', $categoryId)->orderBy('title')->get();
        return json_encode($chapters);
    }
}
