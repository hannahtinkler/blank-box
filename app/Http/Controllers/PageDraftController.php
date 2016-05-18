<?php

namespace App\Http\Controllers;


use App\Http\Requests\PageDraftRequest;
use App\Models\PageDraft;
use App\Services\ControllerServices\PageDraftControllerService;

class PageDraftController extends Controller
{
    private $manager;

    public function __construct(PageDraftControllerService $manager)
    {
        $this->manager = $manager;
    }

    public function store(PageDraftRequest $request, $id = null)
    {
        if ($id != null) {
            $draft = PageDraft::find($id);
            $draft = $this->manager->updatePageDraft($draft, $request->input());
            $draft->updated_at_formatted = $draft->updated_at->format('jS F Y H:i:sa');
        } else {
            $draft = $this->manager->savePageDraft($request->input());
            $draft->updated_at_formatted = $draft->created_at->format('jS F Y H:i:sa');
        }

        return json_encode([
            'draft' => $draft,
            'success' => true
        ]);
    }

    public function preview($id)
    {
        $page = PageDraft::find($id);

        if (!is_object($page)) {
            return \App::abort(404);
        }
        
        return view('pages.preview', compact('page'));
    }
}
