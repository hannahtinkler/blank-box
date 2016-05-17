<?php

namespace App\Http\Controllers;

use App\Models\Page;

class CurationController extends Controller
{
    public function index()
    {
        $pages = Page::where('approved', 0)->get();

        return view('curation.index', compact('pages'));
    }
    
    public function approve($id)
    {
        $page = Page::find($id);
        $page->approved = 1;
        $page->save();
        
        return redirect('/curation')
            ->with('message', 'This page has been approved');
    }
}
