<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\FeedEvent;
use App\Models\SuggestedEdit;

class HomeController extends Controller
{
    public function index()
    {
        $feedEvents = FeedEvent::orderBy('created_at', 'DESC')->paginate(20);

        return view('home.index', compact('feedEvents'));
    }
    
    public function contributors()
    {
        $contributors = Page::select(
            'pages.created_by',
            \DB::raw('COUNT(pages.id) as total')
        )
            ->leftJoin('suggested_edits', 'pages.id', '=', 'suggested_edits.page_id')
            ->orderBy('total', 'desc')
            ->groupBy('pages.created_by')
            ->get();

        return view('home.contributors', compact('contributors'));
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
