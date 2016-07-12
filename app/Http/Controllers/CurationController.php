<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\SuggestedEdit;

class CurationController extends Controller
{
    public function index()
    {
        return redirect('/curation/new');
    }
    
    public function approveEdit($id)
    {
        $edit = SuggestedEdit::find($id);

        $page = Page::find($edit->page_id);
        $page->chapter_id = $edit->chapter_id;
        $page->title = $edit->title;
        $page->description = $edit->description;
        $page->content = $edit->content;
        $page->save();

        $edit->approved = true;
        $edit->save();
        return redirect('/curation/new');
    }
    
    public function rejectEdit($id)
    {
        $edit = SuggestedEdit::find($id);
        $edit->approved = false;
        $edit->save();
        return redirect('/curation/new');
    }
    
    public function newPagesAwaitingApproval()
    {
        $pages = Page::where('approved', null)->get();

        return view('curation.newpages', compact('pages'));
    }

    public function suggestedEditsAwaitingApproval()
    {
        $edits = SuggestedEdit::where('approved', null)->get();

        return view('curation.suggestededits', compact('edits'));
    }
    
    public function approveNewPage($id)
    {
        $page = Page::find($id);
        $page->approved = 1;
        $page->save();
        
        return redirect('/curation/new')
            ->with('message', 'This page has been approved');
    }
    
    public function viewdiff($id)
    {
        $user = \Auth::user();
        $edit = SuggestedEdit::find($id);
        $page = Page::find($edit->page_id);

        $differ = new \cogpowered\FineDiff\Diff;

        $diff = [];
        $diff['category'] = $differ->render($page->chapter->title, $edit->chapter->title);
        $diff['chapter'] = $differ->render($page->chapter->category->title, $edit->chapter->category->title);
        $diff['title'] = $differ->render($page->title, $edit->title);
        $diff['description'] = $differ->render($page->description, $edit->description);
        $diff['content'] = $differ->render($page->content, $edit->content);

        return view('curation.viewdiff', compact('edit', 'diff', 'user'));
    }
}
