<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->first();

        if (!is_object($category)) {
            return \App::abort(404);
        }

        return view('categories.show', compact('category'));
    }
}
