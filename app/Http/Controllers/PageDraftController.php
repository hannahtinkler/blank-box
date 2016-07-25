<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PageDraftRequest;

use App\Models\Chapter;
use App\Models\Category;
use App\Models\PageDraft;
use App\Models\User;

use App\Services\ControllerServices\PageDraftControllerService;

class PageDraftController extends Controller
{
    private $controllerService;

    public function __construct(PageDraftControllerService $controllerService)
    {
        $this->controllerService = $controllerService;
    }

    public function index()
    {
        $drafts = $this->controllerService->getDraftsForUser();

        return view('pagedrafts.index', compact('drafts'));
    }

    public function edit(Request $request, $id)
    {
        $draft = PageDraft::findOrFail($id);

        if ($draft->created_by != $request->user()->id) {
            \App::abort(401);
        }

        $categories = Category::orderBy('title')->get();
        $chapters = Chapter::orderBy('title')->get();

        return view('pagedrafts.edit', compact('draft', 'chapters', 'categories'));
    }

    public function store(PageDraftRequest $request, $id = null)
    {
        if ($id != null) {
            $draft = PageDraft::findOrFail($id);

            if ($draft->created_by != $request->user()->id) {
                return \App::abort(401);
            }

            $draft = $this->controllerService->updatePageDraft($draft, $request->input());
            $draft->updated_at_formatted = $draft->updated_at->format('jS F Y H:i:sa');
        } else {
            $draft = $this->controllerService->savePageDraft($request->input());
            $draft->updated_at_formatted = $draft->created_at->format('jS F Y H:i:sa');
        }

        return json_encode([
            'draft' => $draft,
            'success' => true,
            'count' => $this->controllerService->getDraftsForUser()->count()
        ]);
    }

    public function preview(Request $request, $id)
    {
        $page = PageDraft::findOrFail($id);

        if ($page->created_by != $request->user()->id) {
            return \App::abort(401);
        }
        
        return view('pages.preview', compact('page'));
    }

    public function destroy(Request $request, $id)
    {
        $draft = PageDraft::findOrFail($id);

        if ($draft->created_by != $request->user()->id) {
            \App::abort(401);
        }

        $draft->delete();

        return redirect('/pagedrafts')
            ->with('message', '<i class="fa fa-check"></i> This draft has been successfully deleted');
    }
}
