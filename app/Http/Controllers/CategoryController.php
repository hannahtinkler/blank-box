<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Library\Models\Category;

class CategoryController extends Controller
{
    public function show($catergorySlug)
    {
        $catergory = Category::where('slug', $catergorySlug)->first();
        return view('catergories.show', compact('catergory'));
    }
}
