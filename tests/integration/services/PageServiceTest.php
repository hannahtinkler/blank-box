<?php

namespace Tests\Integration\Services;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\TagService;
use App\Services\PageService;

class PageServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetPageById()
    {
        $page = factory('App\Models\Page')->create();

        $service = new PageService(new TagService);

        $expected = $page->toArray();

        $actual = $service->getById($page->id)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetPageBySlug()
    {
        $page = factory('App\Models\Page')->create();

        $service = new PageService(new TagService);

        $expected = $page->toArray();

        $actual = $service->getBySlug($page->slug)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetPageBySlugForwardingSettings()
    {
        $page = factory('App\Models\Page')->create();

        factory('App\Models\SlugForwardingSetting')->create([
            'old_slug' => 'abcdef',
            'new_slug' => $page->slug,
        ]);

        $service = new PageService(new TagService);

        $expected = $page->toArray();

        $actual = $service->getByForwardedSlug('abcdef')->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetApprovedPagesForUser()
    {
        $page = factory('App\Models\Page')->create(['approved' => true]);

        $service = new PageService(new TagService);

        $expected = [
            $page->toArray()
        ];

        $actual = $service->getApprovedByUserId($page->created_by)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetAllUnapprovedPages()
    {
        $page = factory('App\Models\Page')->create(['approved' => null]);

        $service = new PageService(new TagService);

        $expected = [
            $page->toArray()
        ];

        $actual = $service->getAllUnapproved()->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetRandomPage()
    {
        $page = factory('App\Models\Page')->create(['approved' => 1]);

        $service = new PageService(new TagService);

        $actual = $service->getRandom()->toArray();

        $this->assertInstanceOf('App\Models\Page', $page);
    }

    public function testItCanStorePage()
    {
        $service = new PageService(new TagService);

        $expected = [
            'chapter_id' => 999,
            'title' => "Page 999",
            'description' => "An emergency page!",
            'content' => "Some stuff here",
            'slug' => "page-999",
            'order' => 0,
            'approved' => null,
            'created_by' => 1,
        ];

        $actual = $service->store([
            'chapter_id' => 999,
            'title' => "Page 999",
            'description' => "An emergency page!",
            'content' => "Some stuff here",
            'slug' => "page-999",
            'order' => 0,
            'approved' => null,
            'user_id' => 1,
        ])->toArray();

        unset($actual['id']);
        unset($actual['created_at']);
        unset($actual['updated_at']);
        unset($actual['deleted_at']);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanUpdatePage()
    {
        $page = factory('App\Models\Page')->create();

        $service = new PageService(new TagService);

        $expected = [
            'id' => $page->id,
            'chapter_id' => 999,
            'title' => "Page 999",
            'description' => "An emergency page!",
            'content' => "Some stuff here",
            'slug' => "page-999",
            'order' => $page->order,
            'approved' => null,
            'created_by' => $page->created_by,
            'created_at' => $page->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $page->updated_at->format('Y-m-d H:i:s'),
            'deleted_at' => null,
        ];

        $actual = $service->update(
            $page->id,
            [
                'chapter_id' => 999,
                'title' => 'Page 999',
                'description' => 'An emergency page!',
                'content' => 'Some stuff here',
            ]
        )->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanApprovePage()
    {
        $page = factory('App\Models\Page')->create(['approved' => null]);

        $service = new PageService(new TagService);

        $service->approve($page->id);

        $this->seeInDatabase('pages', [
            'id' => $page->id,
            'approved' => 1,
        ]);
    }
    
    public function testItCanRejectPage()
    {
        $page = factory('App\Models\Page')->create(['approved' => null]);

        $service = new PageService(new TagService);

        $service->reject($page->id);

        $this->seeInDatabase('pages', [
            'id' => $page->id,
            'approved' => 0,
        ]);
    }
}
