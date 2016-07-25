<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();

        return view('categories.show', compact('category'));
    }
}
