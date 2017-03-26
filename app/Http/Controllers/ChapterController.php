<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ChapterService;
use App\Services\CategoryService;

use App\Http\Requests\ChapterRequest;

class ChapterController extends Controller
{
    /**
     * @var ChapterService
     */
    private $chapters;

    /**
     * @var CategoryService
     */
    private $categories;

    /**
     * @param ChapterService  $chapters
     * @param CategoryService $categories
     */
    public function __construct(
        ChapterService $chapters,
        CategoryService $categories
    ) {
        $this->chapters = $chapters;
        $this->categories = $categories;
    }

    /**
     * @param  Request $request
     * @param  string  $categorySlug
     * @param  string  $chapterSlug
     * @return View
     */
    public function show(Request $request, $categorySlug, $chapterSlug)
    {
        $user = $request->user();
        $chapter = $this->chapters->getBySlug($chapterSlug);
        
        return view('chapters.show', compact('chapter', 'user'));
    }

    /**
     * @return View
     */
    public function create()
    {
        $categories = $this->categories->getAll();

        return view('chapters.create', compact('categories'));
    }

    /**
     * @param  ChapterRequest $request
     * @return Redirect
     */
    public function store(ChapterRequest $request)
    {
        $chapter = $this->chapters->store($request->input());

        return redirect($chapter->searchResultUrl())->with(
            'message',
            '<i class="fa fa-check"></i> New chapter has been created'
        );
    
    }

    /**
     * @param  Request $request
     * @param  int  $id
     * @return View
     */
    public function edit(Request $request, $id)
    {
        $chapter = $this->chapters->getById($id);
        $categories = $this->categories->getAll();

        return view('chapters.edit', compact('chapter', 'categories'));
    }

    /**
     * @param  ChapterRequest $request
     * @param  int         $id
     * @return Redirect
     */
    public function update(ChapterRequest $request, $id)
    {
        $chapter = $this->chapters->getById($id);

        $this->chapters->update($chapter, $request->input());

        return redirect($chapter->searchResultUrl())->with(
            'message',
            '<i class="fa fa-check"></i> This chapter has been updated successfully'
        );
    }

    /**
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id)
    {
        $chapter = $this->chapters->getById($id);

        $chapter->delete();

        return redirect('/p/' . $chapter->category->slug)->with(
            'message',
            '<i class="fa fa-check"></i> This chapter has been successfully deleted'
        );
    }

    /**
     * @param  int $categoryId
     * @return string
     */
    public function getChaptersForCategory($categoryId)
    {
        $chapters = $this->chapters->getByCategoryId($categoryId);

        return json_encode($chapters);
    }
}
