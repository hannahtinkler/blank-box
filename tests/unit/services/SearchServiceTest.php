<?php

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
                'url' => "/p/general/optio-saepe-provident-dolores-ratione-voluptas-dolore/hannah",
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
                'url' => "/p/general/optio-saepe-provident-dolores-ratione-voluptas-dolore/hannah",
                'score' => null,
            ]
        ];

        $actual = $service->format([
            $user,
            $page
        ]);

        $this->assertEquals($expected, $actual);
    }

    private function getUser()
    {
        $user = new User;
        $user->id = 1;
        $user->name = 'Hannah Tinkler';
        $user->email = 'hannah.tinkler@gmail.com';
        $user->slug = 'hannah-tinkler';
        $user->default_category_id = 0;
        $user->curator = 0;
        $user->remember_token = 'WQa7Px52bgmBOJLULU53rhXMtUKE0ryTqRGPugtWUfiFratq5SyeJv9Z594m';
        $user->created_at = '2017-03-06 15:28:19';
        $user->updated_at = '2017-03-26 11:43:00';

        return $user;
    }

    private function getPage()
    {
        $page = new Page;
        $page->chapter_id = '1';
        $page->title = 'Hannah';
        $page->description = 'Cum quaerat eveniet, adipisci nobis';
        $page->content = 'Cum quaerat eveniet, adipisci';
        $page->created_by = 1;
        $page->slug = 'hannah';
        $page->order = 0;
        $page->approved = 1;
        $page->updated_at = '2017-03-27 16:26:14';
        $page->created_at = '2017-03-27 16:26:14';
        $page->id = 6;

        return $page;
    }
}
