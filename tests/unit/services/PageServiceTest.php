<?php

use App\Services\PageService;

class PageServiceTest extends TestCase
{
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

        $page = factory('App\Models\Page')->create();

        $service = new PageService;

        $expected = 1;
        $actual = $service->shouldBeApproved(['approved' => 1], $page);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanTellIfPageShouldBeApprovedIfCurrentPageIsAlreadyApproved()
    {
        putenv('FEATURE_CURATION_ENABLED=true');

        $page = factory('App\Models\Page')->create(['approved' => true]);

        $service = new PageService;

        $expected = 1;
        $actual = $service->shouldBeApproved([], $page);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanTellIfPageShouldBeApprovedIfCureationIsOff()
    {
        putenv('FEATURE_CURATION_ENABLED=true');

        $page = factory('App\Models\Page')->create();

        $service = new PageService;

        $expected = null;
        $actual = $service->shouldBeApproved([], $page);

        $this->assertEquals($expected, $actual);
    }
}
