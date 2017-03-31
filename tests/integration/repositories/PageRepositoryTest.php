<?php

namespace Tests\Integration\Repositories;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Repositories\PageRepository;

class PageRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetSearchResultUrl()
    {
        $page = factory('App\Models\Page')->create();

        $expected = sprintf('/p/%s/%s/%s', $page->chapter->category->slug, $page->chapter->slug, $page->slug);

        $actual = $page->searchResultUrl;

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetSearchResultString()
    {
        $page = factory('App\Models\Page')->create();

        $expected = 'Page: ' . $page->title;

        $actual = $page->searchResultString;

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetSearchResultIcon()
    {
        $page = factory('App\Models\Page')->create();

        $expected = '<i class="fa fa-file-o"></i>';

        $actual = $page->searchResultIcon;

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetUpdatorsString()
    {
        $page = factory('App\Models\Page')->create();

        $edit1 = factory('App\Models\SuggestedEdit')->create(['approved' => 1, 'page_id' => $page->id]);
        $edit2 = factory('App\Models\SuggestedEdit')->create(['approved' => 1, 'page_id' => $page->id]);
        $edit3 = factory('App\Models\SuggestedEdit')->create(['approved' => 1, 'page_id' => $page->id]);

        $expected = sprintf(
            '<strong><a href="/u/%s">%s</a></strong>, <strong><a href="/u/%s">%s</a></strong>, <strong><a href="/u/%s">%s</a></strong>',
            $edit1->creator->slug,
            $edit1->creator->name,
            $edit2->creator->slug,
            $edit2->creator->name,
            $edit3->creator->slug,
            $edit3->creator->name
        );

        $actual = $page->updatorsString;

        $this->assertEquals($expected, $actual);
    }
}
