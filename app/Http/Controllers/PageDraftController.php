<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PageDraftRequest;

use League\CommonMark\CommonMarkConverter;

use App\Services\PageDraftService;
use App\Services\CategoryService;
use App\Services\ChapterService;

class PageDraftController extends Controller
{
    /**
     * @var PageDraftService
     */
    private $drafts;
    
    /**
     * @var CategoryService
     */
    private $categories;
    
    /**
     * @var ChapterService
     */
    private $chapters;
    
    /**
     * @var CommonMarkConverter
     */
    private $converter;

    /**
     * @param PageDraftService    $drafts
     * @param CategoryService     $categories
     * @param ChapterService      $chapters
     * @param CommonMarkConverter $converter
     */
    public function __construct(
        PageDraftService $drafts,
        CategoryService $categories,
        ChapterService $chapters,
        CommonMarkConverter $converter
    ) {
        $this->drafts = $drafts;
        $this->categories = $categories;
        $this->chapters = $chapters;
        $this->converter = $converter;
    }

    /**
     * @param  Request $request
     * @param  string  $userSlug
     * @return View
     */
    public function index(Request $request, $userSlug)
    {
        $user = $request->user();

        $drafts = $this->drafts->getAllByUserId($user->id);

        return view('pagedrafts.index', compact('drafts', 'user'));
    }

    /**
     * @param  Request $request
     * @param  string  $userSlug
     * @param  int  $id
     * @return View
     */
    public function edit(Request $request, $userSlug, $id)
    {
        $draft = $this->drafts->getById($id);

        $categories = $this->categories->getAll();
        $chapters = $draft->chapter_id ? $this->chapters->getByCategoryId($draft->chapter->category_id) : [];
        $user = $request->user();

        return view('pagedrafts.edit', compact('draft', 'chapters', 'categories', 'user'));
    }

    /**
     * @param  PageDraftRequest $request
     * @param  string           $userSlug
     * @param  int              $id
     * @return string
     */
    public function store(PageDraftRequest $request, $userSlug, $id = null)
    {
        $data = $request->input();
        $user = $request->user();

        if ($id) {
            $draft = $this->drafts->update($id, $data);
        } else {
            $draft = $this->drafts->store($user->id, $data);
        }
     
        $draft->updated_at_formatted = $draft->created_at->format('jS F Y H:i:sa');

        return json_encode([
            'draft' => $draft,
            'success' => true,
            'count' => $this->drafts->getAllByUserId($user->id)->count(),
        ]);
    }

    /**
     * @param  string $userSlug
     * @param  int $id
     * @return View
     */
    public function preview($userSlug, $id)
    {
        $page = $this->drafts->getById($id);

        $page->content = $this->converter->convertToHtml($page->content);

        return view('pages.preview', compact('page'));
    }

    /**
     * @param  string $userSlug
     * @param  int $id
     * @return Redirect
     */
    public function destroy($userSlug, $id)
    {
        $this->drafts->delete($id);

        return redirect('/u/' . $userSlug . '/drafts')->with(
            'message',
            '<i class="fa fa-check"></i> This draft has been deleted'
        );
    }
}
