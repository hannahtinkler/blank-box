<?php

namespace App\Http\Controllers;

use Event;

use Illuminate\Http\Request;

use App\Events\PageWasAdded;

use App\Services\CurationService;
use App\Services\PageService;
use App\Services\SuggestedEditService;

class CurationController extends Controller
{
    /**
     * @var CurationService
     */
    private $curation;

    /**
     * @var PageService
     */
    private $pages;

    /**
     * @var SuggestedEditService
     */
    private $suggestedEdits;

    /**
     * @param CurationService      $curation
     * @param PageService          $pages
     * @param SuggestedEditService $suggestedEdits
     */
    public function __construct(
        CurationService $curation,
        PageService $pages,
        SuggestedEditService $suggestedEdits
    ) {
        $this->curation = $curation;
        $this->pages = $pages;
        $this->suggestedEdits = $suggestedEdits;
    }

    /**
     * @return Redirect
     */
    public function index()
    {
        return redirect('/curation/new');
    }
    
    /**
     * @return View
     */
    public function newPagesAwaitingApproval()
    {
        $pages = $this->pages->getAllUnapproved();

        return view('curation.newpages', compact('pages'));
    }

    /**
     * @return View
     */
    public function suggestedEditsAwaitingApproval()
    {
        $edits = $this->suggestedEdits->getAllUnapproved();

        return view('curation.suggestededits', compact('edits'));
    }
    
    /**
     * @param  int $id
     * @return Redirect
     */
    public function approveNewPage($id)
    {
        $this->pages->approve($id);

        Event::fire(new PageWasAdded($page, $page->creator));

        return redirect('/curation/new')->with(
            'message',
            '<i class="fa fa-check"></i> This page has been approved'
        );
    }
    
    /**
     * @param  int $id
     * @return Redirect
     */
    public function rejectNewPage($id)
    {
        $this->pages->reject($id);

        return redirect('/curation/new')->with(
            'message',
            '<i class="fa fa-check"></i> This page has been rejected'
        );
    }
    
    /**
     * @param  int $id
     * @return Redirect
     */
    public function approveEdit($id)
    {
        $edit = $this->suggestedEdits->getById($id);
        
        $this->pages->update($edit->page_id, [
            'chapter_id' => $edit->chapter_id,
            'title' => $edit->title,
            'description' => $edit->description,
            'content' => $edit->content,
            'approved' => 1
        ]);
        
        $this->suggestedEdits->approve($edit->id);

        return redirect('/curation/edits')->with(
            'message',
            '<i class="fa fa-check"></i> This suggested edit has been approved and merged into the original page.'
        );
    }
    
    /**
     * @param  int $id
     * @return Redirect
     */
    public function rejectEdit($id)
    {
        $this->suggestedEdits->reject($id);

        return redirect('/curation/edits')->with(
            'message',
            '<i class="fa fa-check"></i> This suggested edit has been rejected and will not be merged into the original page.'
        );
    }
    
    /**
     * @param  Request $request
     * @param  int  $id
     * @return View
     */
    public function viewDiff(Request $request, $id)
    {
        $user = $request->user();

        $edit = $this->suggestedEdits->getById($id);
        
        $page = $this->pages->getById($id);

        $diff = $this->curation->getPageDiff($page, $edit);

        return view('curation.viewdiff', compact('edit', 'diff', 'user'));
    }
}
