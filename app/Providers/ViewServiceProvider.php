<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

use App\Services\PageService;
use App\Services\ChapterService;
use App\Services\CategoryService;
use App\Services\PageDraftService;
use App\Services\SuggestedEditService;
use App\Services\BadgeService;

class ViewServiceProvider extends ServiceProvider
{

    /**
     * @var Request
     */
    private $request;

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * @var ChapterService
     */
    private $chapterService;

    /**
     * @var PageService
     */
    private $pageService;

    /**
     * @var PageDraftService
     */
    private $pageDraftService;

    /**
     * @var SuggestedEditService
     */
    private $suggestedEditService;

    /**
     * @var BadgeService
     */
    private $userBadgeService;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(
        Request $request,
        CategoryService $categoryService,
        ChapterService $chapterService,
        PageService $pageService,
        PageDraftService $pageDraftService,
        SuggestedEditService $suggestedEditService,
        BadgeService $userBadgeService
    ) {
        $this->request = $request;
        $this->categoryService = $categoryService;
        $this->chapterService = $chapterService;
        $this->pageService = $pageService;
        $this->pageDraftService = $pageDraftService;
        $this->suggestedEditService = $suggestedEditService;
        $this->userBadgeService = $userBadgeService;

        view()->composer('layouts.master', function ($view) {
            $user = auth()->user();

            $current = $this->getCurrentMeta();

            $categories = $this->categoryService->getAll();

            $drafts = $this->pageDraftService->getAllByUserId($user->id)->count();

            $curation = [
                'new' => $this->pageService->getAllUnapproved()->count(),
                'edits' => $this->suggestedEditService->getAllUnapproved()->count(),
            ];

            $newBadgeCount = $this->userBadgeService->getUnreadByUserId($user->id)->count();

            $view->with('categories', $categories)
                ->with('current', $current)
                ->with('user', $user)
                ->with('drafts', $drafts)
                ->with('curation', $curation)
                ->with('newBadgeCount', $newBadgeCount);
        });
    }

    public function register()
    {
        //
    }

    public function getCurrentMeta()
    {
        $current = [
            'category' => $this->categoryService->getCurrent(),
        ];

        if ($this->request->segment(1) == 'p') {
            $current = array_merge($current, [
                'chapter' => $this->chapterService->getBySlug($this->request->segment(3)),
                'page' => $this->pageService->getBySlug($this->request->segment(4)),
            ]);
        }

        return $current;
    }
}
