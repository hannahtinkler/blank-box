<?php

use App\Events\PageWasAdded;

class PageWasAddedTest extends TestCase
{
    public function testItReturnsCorrectProperties()
    {
        $page = factory(App\Models\Page::class)->create();
        $user = factory(App\Models\User::class)->create();

        $expected = $page;
        $actual = (new PageWasAdded($page, $user))->page;
        $this->assertEquals($expected, $actual);

        $expected = 'pagesSubmitted';
        $actual = (new PageWasAdded($page, $user))->metric;
        $this->assertEquals($expected, $actual);

    }
}
