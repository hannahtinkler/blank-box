<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\FeedEvent;
use App\Models\Contributor;
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
        $pages = Page::select(
            'pages.created_by as user_id',
            'users.slug as slug',
            'users.name as user_name',
            \DB::raw('COUNT(pages.id) as total')
        )
            ->join('users', 'users.id', '=', 'pages.created_by');

        $pages = SuggestedEdit::select(
            'suggested_edits.created_by as user_id',
            'users.slug as slug',
            'users.name as user_name',
            \DB::raw('COUNT(pages.id) as total')
        )
            ->join('users', 'users.id', '=', 'suggested_edits.created_by');
        
        $contributors = Contributor::select([
            'contributors.user_id as user_id',
            'users.slug as slug',
            'users.name as user_name',
            'count as total'
        ])
            ->join('users', 'users.id', '=', 'contributors.user_id')
            ->orderBy('total', 'desc')
            ->groupBy('user_id')
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
