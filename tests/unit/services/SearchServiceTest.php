<?php

namespace Tests\Unit\Services;

use TestCase;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\SearchService;

use App\Models\User;
use App\Models\Page;

use App\Services\PageService;
use App\Services\UserService;
use App\Services\ChapterService;

class SearchServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanProcessSearch()
    {
        $user = $this->getUser();
        $page = $this->getPage();

        $request = $this->mock(Request::class);
        $pageService = $this->mock(PageService::class);
        $chapterService = $this->mock(ChapterService::class);
        $userService = $this->mock(UserService::class);

        $request->ajax()->willReturn(true)->shouldBeCalled();

        $userService->search('hannah')->willReturn(Collection::make([$user]))->shouldBeCalled();
        $pageService->search('hannah')->willReturn(Collection::make([$page]))->shouldBeCalled();
        $chapterService->search('hannah')->willReturn(Collection::make([]))->shouldBeCalled();

        $service = new SearchService(
            $request->reveal(),
            $pageService->reveal(),
            $chapterService->reveal(),
            $userService->reveal()
        );

        $expected = [
            [
                'content' => "User: Hannah Tinkler",
                'url' => "/u/hannah-tinkler",
                'score' => null,
            ],
            [
                'content' => "Page: Hannah",
                'url' => "/p/general/sample/hannah",
                'score' => null,
            ]
        ];

        $actual = $service->process('hannah', ['users', 'pages', 'chapters']);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanFormatResults()
    {
        $user = $this->getUser();
        $page = $this->getPage();

        $request = $this->mock(Request::class);
        $pageService = $this->mock(PageService::class);
        $chapterService = $this->mock(ChapterService::class);
        $userService = $this->mock(UserService::class);

        $request->ajax()->willReturn(true)->shouldBeCalled();

        $service = new SearchService(
            $request->reveal(),
            $pageService->reveal(),
            $chapterService->reveal(),
            $userService->reveal()
        );

        $expected = [
            [
                'content' => "User: Hannah Tinkler",
                'url' => "/u/hannah-tinkler",
                'score' => null,
            ],
            [
                'content' => "Page: Hannah",
                'url' => "/p/general/sample/hannah",
                'score' => null,
            ]
        ];

        $actual = $service->format([
            $user,
            $page
        ]);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanSortResults()
    {
        $request = $this->mock(Request::class);
        $pageService = $this->mock(PageService::class);
        $chapterService = $this->mock(ChapterService::class);
        $userService = $this->mock(UserService::class);

        $request->ajax()->willReturn(true)->shouldBeCalled();

        $service = new SearchService(
            $request->reveal(),
            $pageService->reveal(),
            $chapterService->reveal(),
            $userService->reveal()
        );

        $user = $this->mock(User::class);
        $page = $this->mock(Page::class);

        $user->documentScore()->willReturn(1)->shouldBeCalled();
        $page->documentScore()->willReturn(5)->shouldBeCalled();
        $user->getAttribute('name')->willReturn('user')->shouldBeCalled();
        $page->getAttribute('name')->willReturn('page')->shouldBeCalled();

        $sorted = $service->sort([
            $user->reveal(),
            $page->reveal(),
        ]);

        $this->assertEquals('page', $sorted[0]->name);
        $this->assertEquals('user', $sorted[1]->name);
    }

    private function getUser()
    {
        $user = new User();
        $user->id = 1;
        $user->name = 'Hannah Tinkler';
        $user->email = 'hannah.tinkler@gmail.com';
        $user->slug = 'hannah-tinkler';
        $user->default_category_id = 0;
        $user->curator = 0;
        $user->remember_token = 'WQa7Px52bgmBOJLULU53rhXMtUKE0';
        $user->created_at = '2017-03-06 15:28:19';
        $user->updated_at = '2017-03-26 11:43:00';

        return $user;
    }

    private function getPage()
    {
        $page = new Page;
        $page->id = 6;
        $page->chapter_id = 1;
        $page->title = 'Hannah';
        $page->description = 'Cum quaerat eveniet, adipisci nobis';
        $page->content = 'Cum quaerat eveniet, adipisci';
        $page->created_by = 1;
        $page->slug = 'hannah';
        $page->order = 0;
        $page->approved = 1;
        $page->updated_at = '2017-03-27 16:26:14';
        $page->created_at = '2017-03-27 16:26:14';

        return $page;
    }
}
