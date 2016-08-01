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

    public function index(Request $request, $userSlug)
    {
        $user = $request->user();

        $drafts = $this->controllerService->getDraftsForUser();

        return view('pagedrafts.index', compact('drafts', 'user'));
    }

    public function edit(Request $request, $userSlug, $id)
    {
        $draft = PageDraft::findOrFail($id);

        $categories = Category::orderBy('title')->get();
        $chapters = Chapter::orderBy('title')->get();
        $user = $request->user();

        return view('pagedrafts.edit', compact('draft', 'chapters', 'categories', 'user'));
    }

    public function store(PageDraftRequest $request, $userSlug, $id = null)
    {
        if ($id != null) {
            $draft = PageDraft::findOrFail($id);

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

    public function preview(Request $request, $userSlug, $id)
    {
        $page = PageDraft::findOrFail($id);
        
        return view('pages.preview', compact('page'));
    }

    public function destroy(Request $request, $userSlug, $id)
    {
        $user = $request->user();
        $draft = PageDraft::findOrFail($id);

        $draft->delete();

        return redirect('/u/' . $user->slug . '/drafts')
            ->with('message', '<i class="fa fa-check"></i> This draft has been successfully deleted');
    }
}
