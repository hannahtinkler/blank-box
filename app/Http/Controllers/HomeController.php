<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Library\Models\Page;
use App\Library\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
    
    public function getRandomPage()
    {
        $page = Page::orderByRaw("RAND()")->first();
        return redirect('/p/' . $page->chapter->category->slug . '/' . $page->chapter->slug . '/' . $page->slug);
    }
    
    public function switchCategory($id)
    {
        \Session::set('currentCategoryId', $id);
        return redirect(\URL::previous());
    }
}
