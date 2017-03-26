<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;

class CategoryController extends Controller
{
    /**
     * @var Category
     */
    private $categories;

    /**
     * @param CategoryService $categories
     */
    public function __construct(CategoryService $categories)
    {
        $this->categories = $categories;
    }

    /**
     * @param  string $slug
     * @return View
     */
    public function show($slug)
    {
        $category = $this->categories->getBySlug($slug);

        return view('categories.show', compact('category'));
    }
}
