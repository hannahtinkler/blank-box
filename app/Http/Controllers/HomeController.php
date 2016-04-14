<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Library\Models\Page;

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
}
