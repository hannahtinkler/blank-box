<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Page;

class PageController extends Controller
{
    public function show($categorySlug, $chapterSlug, $pageSlug)
    {
        $page = Page::where('slug', $pageSlug)->first();
        return view('pages.show', compact('page'));
    }
}
