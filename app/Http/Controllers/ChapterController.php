<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Library\Models\Chapter;

class ChapterController extends Controller
{
    public function show($chapterSlug)
    {
        $chapter = Chapter::where('slug', $chapterSlug)->first();
        return view('chapters.show', compact('chapter'));
    }
}
