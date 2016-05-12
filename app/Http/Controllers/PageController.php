<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
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

        if (!is_object($page)) {
            return \App::abort(404);
        }
        
        return view('pages.show', compact('page'));
    }
    
    public function previewPage($id)
    {
        $page = PageDraft::find($id);

        if (!is_object($page)) {
            return \App::abort(404);
        }
        
        return view('pages.preview', compact('page'));
    }
    
    public function create()
    {
        $categories = Category::orderBy('title')->get();
        $chapters = Chapter::orderBy('title')->get();

        return view('pages.create', compact('categories', 'chapters'));
    }

    public function edit($id)
    {
        $page = Page::find($id);
        $categories = Category::orderBy('title')->get();
        $chapters = Chapter::where('category_id', $page->chapter->category_id)->orderBy('title')->get();

        return view('pages.edit', compact('page', 'categories', 'chapters'));
    }

    public function update($id, PageRequest $request)
    {
        $updatePage = Page::find($id);

        $updatePage->update($request->only(
            'chapter_id',
            'title',
            'description',
            'content'
        ));

        $updatePage->slug = str_slug($request->input('title'));
        $updatePage->save();

        $this->deleteCurrentDraft($request->input('last_draft_id'));

        return redirect('/p/' . $updatePage->chapter->category->slug .
            '/' . $updatePage->chapter->slug . '/' .
            $updatePage->slug)->with(
                'message',
                '<i class="fa fa-check"></i> This page has been edited successfully and you\'re now viewing it. Only you will be able to see it until it has been curated.'
            );
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

    public function save(Request $request)
    {
        
        $validation = \Validator::make($request->input(), [
            'category_id' => 'required|numeric|exists:categories,id',
            'chapter_id' => 'required|numeric|exists:chapters,id',
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'content' => 'required|min:10'
        ]);

        if ($validation->fails()) {
            return back()->with('errorMessages', $validation->messages()->messages())->withInput();
        }

        $currentOrderValue = Page::where('chapter_id', $request->input('chapter_id'))->orderBy('order', 'desc')->first();
        $nextOrderValue = is_object($currentOrderValue) ? $currentOrderValue->order + 1 : 1;

        $page = Page::create([
            'chapter_id' => $request->input('chapter_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'content' => $request->input('content'),
            'slug' => str_slug($request->input('title')),
            'order' => $nextOrderValue,
            'approved' => $request->input('approved', false)
        ]);

        $this->deleteCurrentDraft($request->input('last_draft_id'));

        return redirect('/p/' . $page->chapter->category->slug . '/' . $page->chapter->slug . '/' . $page->slug)->with('message', '<i class="fa fa-check"></i> This page has been saved and you\'re now viewing it. Only you will be able to see it until it has been curated.');
    }
    
    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();

        return redirect('/p/' . $page->chapter->category->slug . '/' . $page->chapter->slug)
        ->with('message', 'Page has been successfully deleted');
    }

    private function deleteCurrentDraft($id)
    {
        if (!empty($id)) {
            $currentDraft = PageDraft::find($id);
            $currentDraft->delete();
        }
    }
}
