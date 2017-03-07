<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\Page;
use App\Models\FeedEvent;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $feedEvents = FeedEvent::orderBy('created_at', 'DESC')->paginate(20);

        $daysTilXmas = Carbon::createFromDate(2017, 12, 25)->diff(Carbon::createFromDate())->days;

        return view('home.index', compact('feedEvents', 'daysTilXmas'));
    }
    
    public function getRandomPage()
    {
        $page = Page::where('approved', 1)->orderByRaw("RAND()")->first();
        return redirect('/p/' . $page->chapter->category->slug . '/' . $page->chapter->slug . '/' . $page->slug);
    }
    
    public function switchCategory($id)
    {
        \Session::set('currentCategoryId', $id);

        $user = \Auth::user();
        $user->default_category_id = $id;
        $user->save();

        return redirect(\URL::previous());
    }
}
