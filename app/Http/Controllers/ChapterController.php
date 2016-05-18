<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Category;
use App\Http\Requests\ChapterRequest;

class ChapterController extends Controller
{
    public function show($categorySlug, $chapterSlug)
    {
        $chapter = Chapter::findBySlug($chapterSlug);
        
        return view('chapters.show', compact('chapter'));
    }

    public function getChaptersForCategory($categoryId)
    {
        $chapters = Chapter::where('category_id', $categoryId)->orderBy('title')->get();
        return json_encode($chapters);
    }

    public function create()
    {
            $categories = Category::orderBy('title')->get();

            return view('chapters.create', compact('categories'));
    }

    public function store(ChapterRequest $request)
    {

        $validation = \Validator::make($request->input(), [
            'category_id' => 'required|numeric|exists:categories,id',
            'title' => 'required|min:3',
            'description' => 'required|min:10',
        ]);

        if ($validation->fails()) {
            return back()->with('errorMessages', $validation->messages()->messages())->withInput();
        }

        $currentOrderValue = Chapter::where('category_id', $request->input('category_id'))->orderBy('order', 'desc')->first();
        $nextOrderValue = is_object($currentOrderValue) ? $currentOrderValue->order + 1 : 1;

        $chapter = Chapter::create([
                                 'category_id' => $request->input('category_id'),
                                 'title' => $request->input('title'),
                                 'description' => $request->input('description'),
                                 'order' => $nextOrderValue,
                                 'slug' => str_slug($request->input('title')),
                             ]);

        return redirect('/p/' . $chapter->category->slug . '/' . $chapter->slug)->with('message', '<i class="fa fa-check"></i>New chapter has been created');
    }

}
