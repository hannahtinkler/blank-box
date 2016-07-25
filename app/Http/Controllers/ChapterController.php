<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Category;

use App\Http\Requests\ChapterRequest;

use App\Services\ControllerServices\ChapterControllerService;

class ChapterController extends Controller
{
    private $controllerService;

    public function __construct(ChapterControllerService $controllerService)
    {
        $this->controllerService = $controllerService;
    }

    public function show($categorySlug, $chapterSlug)
    {
        $chapter = Chapter::findBySlug($chapterSlug);
        
        return view('chapters.show', compact('chapter'));
    }

    public function create()
    {
        $categories = Category::orderBy('title')->get();

        return view('chapters.create', compact('categories'));
    }

    public function store(ChapterRequest $request)
    {
        $chapter = $this->controllerService->storeChapter($request->input());

        return redirect($chapter->searchResultUrl())->with('message', '<i class="fa fa-check"></i> New chapter has been created');
    
    }


    public function edit($id)
    {
        if (!$this->controllerService->user->curator) {
            return \App::abort(401);
        }

        $chapter = Chapter::findOrFail($id);
        $categories = Category::orderBy('title')->get();

        return view('chapters.edit', compact('chapter', 'categories'));
    }

    public function update($id, ChapterRequest $request)
    {
        if (!$this->controllerService->user->curator) {
            return \App::abort(401);
        }

        $chapter = Chapter::findOrFail($id);
        $this->controllerService->updateChapter($chapter, $request->input());

        return redirect($chapter->searchResultUrl())->with(
            'message',
            '<i class="fa fa-check"></i> This chapter has been updated successfully'
        );
    }

    public function destroy($id)
    {
        if (!$this->controllerService->user->curator) {
            return \App::abort(401);
        }

        $chapter = Chapter::findOrFail($id);
        $chapter->delete();

        return redirect('/p/' . $chapter->category->slug)
        ->with(
            'message',
            '<i class="fa fa-check"></i> This chapter has been successfully deleted'
        );
    }

    public function getChaptersForCategory($categoryId)
    {
        $chapters = Chapter::where('category_id', $categoryId)->orderBy('title')->get();

        return json_encode($chapters);
    }
}
