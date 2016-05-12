<?php

namespace App\Http\Controllers;

use App\Models\Page;

class UpdatedPagesController extends Controller
{
    public function index()
    {
        $updatedPages = $this->getLatestPages();
        return view('updated-pages.index', compact('updatedPages'));
    }
    
    private function getLatestPages() 
    {
        return Page::orderBy('updated_at', 'DESC')->paginate(10);
    }
}
