<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Page;
use App\Models\PageDraft;

class PageController extends Controller
{
    public function show($categorySlug, $chapterSlug, $pageSlug)
    {
        $page = Page::where('slug', $pageSlug)->first();
        return view('pages.show', compact('page'));
    }
    
    public function previewPage($id)
    {
        $page = PageDraft::find($id);
        return view('pages.preview', compact('page'));
    }
    
    public function create()
    {
        $categories = Category::orderBy('title')->get();
        $chapters = Chapter::orderBy('title')->get();

        return view('pages.create', compact('categories', 'chapters'));
    }

    public function savePreview(Request $request, $id = null)
    {
        if ($id != null) {
            $draft = PageDraft::find($id);
            $draft->chapter_id = $request->input('chapter_id');
            $draft->title = $request->input('title');
            $draft->description = $request->input('description');
            $draft->content = $request->input('content');
            $draft->save();
            $draft->updated_at_formatted = $draft->updated_at->format('jS F Y H:i:sa');
        } else {
            $draft = PageDraft::create([
                'chapter_id' => $request->input('chapter_id'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'content' => $request->input('content')
            ]);
            $draft->updated_at_formatted = $draft->created_at->format('jS F Y H:i:sa');
        }

        return json_encode([
            'draft' => $draft,
            'success' => true
        ]);
    }

    public function save()
    {
        $categories = Category::orderBy('title')->get();
        $chapters = Chapter::orderBy('title')->get();

        return view('pages.create', compact('categories', 'chapters'));
    }
}
