<?php

use App\Events\PageWasAddedToChapter;

class PageWasAddedToChapterTest extends TestCase
{
    public function testItReturnsCorrectProperties()
    {
        $page = factory(App\Models\Page::class)->create();
        $user = factory(App\Models\User::class)->create();

        $expected = $page;
        $actual = (new PageWasAddedToChapter($page, $user))->page;
        $this->assertEquals($expected, $actual);

        $expected = $user;
        $actual = (new PageWasAddedToChapter($page, $user))->user;
        $this->assertEquals($expected, $actual);

    }
}
