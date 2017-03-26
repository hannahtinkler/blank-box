<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Page;

use App\Models\UserBadge;
use App\Services\PageService;

class PageServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetPageById()
    {
        $page = factory(Page::class)->create(['approved' => true]);

        $service = new PageService;

        $expected = $page->toArray();

        $actual = $service->getById($page->id)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetPagesForUser()
    {
        $page = factory(Page::class)->create(['approved' => true]);

        $service = new PageService;

        $expected = [
            $page->toArray()
        ];

        $actual = $service->getApprovedByUserId($page->created_by)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetAllApprovedPages()
    {
        $page = factory(Page::class)->create(['approved' => null]);

        $service = new PageService;

        $expected = [
            $page->toArray()
        ];

        $actual = $service->getAllUnapproved()->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetRandomPage()
    {
        $page = factory(Page::class)->create(['approved' => 1]);

        $service = new PageService;

        $actual = $service->getAllUnapproved()->toArray();

        $this->assertInstanceOf(Page::class, $page);
    }

    public function testItCanUpdatePage()
    {
        $page = factory('App\Models\Page')->create();

        $service = new PageService;

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
        $page = factory(Page::class)->create(['approved' => null]);

        $service = new PageService;

        $service->approve($page->id);

        $expected = 1;
        $acual = Page::find($page->id)->approved;

        $this->assertEquals($expected, $acual);
    }
    
    public function testItCanRejectPage()
    {
        $page = factory(Page::class)->create(['approved' => null]);

        $service = new PageService;

        $service->reject($page->id);

        $expected = 0;
        $acual = Page::find($page->id)->approved;

        $this->assertEquals($expected, $acual);
    }

    public function testItCanTellIfPageShouldBeApprovedIfCurationIsOff()
    {
        putenv('FEATURE_CURATION_ENABLED=false');

        $service = new PageService;

        $expected = 1;
        $actual = $service->shouldBeApproved(['approved' => null]);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanTellIfPageShouldBeApprovedIfDataHasApprovedTrue()
    {
        putenv('FEATURE_CURATION_ENABLED=true');

        $page = factory(Page::class)->create();

        $service = new PageService;

        $expected = 1;
        $actual = $service->shouldBeApproved(['approved' => 1], $page);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanTellIfPageShouldBeApprovedIfCurrentPageIsAlreadyApproved()
    {
        putenv('FEATURE_CURATION_ENABLED=true');

        $page = factory(Page::class)->create(['approved' => true]);

        $service = new PageService;

        $expected = 1;
        $actual = $service->shouldBeApproved([], $page);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanTellIfPageShouldBeApprovedIfCureationIsOff()
    {
        putenv('FEATURE_CURATION_ENABLED=true');

        $page = factory(Page::class)->create();

        $service = new PageService;

        $expected = null;
        $actual = $service->shouldBeApproved([], $page);

        $this->assertEquals($expected, $actual);
    }
}
