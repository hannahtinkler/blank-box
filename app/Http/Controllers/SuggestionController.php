<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Page;
use App\Models\Comment;

class SuggestionController extends Controller
{
    public function comment($id)
    {
        $page = Page::find($id);
        $categories = Category::orderBy('title')->get();
        $chapters = Chapter::where('category_id', $page->chapter->category_id)->orderBy('title')->get();

        return view('pages.comment', compact('page', 'categories', 'chapters'));
    }
    
    public function saveComment(Request $request)
    {
        Comment::create([
            'page_id' => $request->input('page_id'),
            'comment' => $request->input('comment'),
            'approved' => $request->input('approved', false)
        ]);
        
        $page = Page::find($request->input('page_id'));

        return redirect('/p/' . $page->chapter->category->slug . '/' . $page->chapter->slug . '/' . $page->slug)->with('message', '<i class="fa fa-check"></i> Thank you, your comment has been saved');
    }
}
