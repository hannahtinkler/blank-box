<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->first();
        return view('categories.show', compact('category'));
    }
}
