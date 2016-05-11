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

        if (!is_object($category)) {
            throw new \Exception("Invalid data received");
        }

        return view('categories.show', compact('category'));
    }
}
