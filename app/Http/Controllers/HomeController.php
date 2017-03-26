<?php

namespace App\Http\Controllers;

use URL;
use Session;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        $feedEvents = $this->feedEvents->getAllPaginated();

        return view('home.index', compact('feedEvents'));
    }
    
    /**
     * @return Redirect
     */
    public function getRandomPage()
    {
        $page = $this->pages->getRandom();

        return redirect('/p/' . $page->chapter->category->slug . '/' . $page->chapter->slug . '/' . $page->slug);
    }
    
    /**
     * @param  Request $request
     * @param  int  $id
     * @return Redirect
     */
    public function switchCategory(Request $request, $id)
    {
        Session::set('currentCategoryId', $id);

        $user = $request->user();
        $user->default_category_id = $id;
        $user->save();

        return redirect(URL::previous());
    }
}
