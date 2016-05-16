<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\PageDraft;

class PageDraftController extends Controller
{
    public function preview($id)
    {
        $page = PageDraft::find($id);

        if (!is_object($page)) {
            return \App::abort(404);
        }
        
        return view('pages.preview', compact('page'));
    }
}
