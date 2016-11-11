<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\SuggestedEdit;

use App\Services\ControllerServices\CurationControllerService;

class CurationController extends Controller
{
    private $controllerService;

    public function __construct(CurationControllerService $controllerService)
    {
        $this->controllerService = $controllerService;
    }

    public function index()
    {
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
        $this->controllerService->approveNewPage($id);

        return redirect('/curation/new')
            ->with('message', '<i class="fa fa-check"></i> This page has been approved');
    }

    public function rejectNewPage($id)
    {
        $this->controllerService->rejectNewPage($id);
        return redirect('/curation/new')
            ->with('message', '<i class="fa fa-check"></i> This page has been rejected');
    }

    public function approveEdit($id)
    {
        $this->controllerService->approveSuggestedEdit($id);

        return redirect('/curation/edits')
            ->with('message', '<i class="fa fa-check"></i> This suggested edit has been approved and merged into the original page.');
    }

    public function rejectEdit($id)
    {
        $this->controllerService->rejectSuggestedEdit($id);
        return redirect('/curation/edits')
            ->with('message', '<i class="fa fa-check"></i> This suggested edit has been rejected and will not be merged into the original page.');
    }

    public function viewdiff(Request $request, $id)
    {
        $user = $request->user();
        $edit = SuggestedEdit::find($id);
        $page = Page::find($edit->page_id);

        $diff = $this->controllerService->getPageDiff($page, $edit);

        return view('curation.viewdiff', compact('edit', 'diff', 'user'));
    }
}
