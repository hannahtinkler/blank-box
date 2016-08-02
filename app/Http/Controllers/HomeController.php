<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\FeedEvent;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $feedEvents = FeedEvent::orderBy('created_at', 'DESC')->paginate(20);

        return view('home.index', compact('feedEvents'));
    }
    
    public function contributors()
    {
        $contributors = User::select([
                'users.*',
                \DB::raw('(
                    COALESCE(
                        (SELECT COUNT(*) FROM pages WHERE pages.created_by=users.id),
                        0
                    ) + COALESCE(
                        (SELECT COUNT(*) FROM suggested_edits WHERE suggested_edits.created_by=users.id AND approved=1),
                        0
                    ) + COALESCE(
                        (SELECT count FROM contributors WHERE contributors.user_id=users.id),
                        0
                    )
                ) as total')
            ])
            ->having('total', '>', 0)
            ->orderBy('total', 'DESC')
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
