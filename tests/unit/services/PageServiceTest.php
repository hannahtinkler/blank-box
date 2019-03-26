<?php

namespace Tests\Unit\Services;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\TagService;
use App\Services\PageService;

class PageServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanTellIfPageShouldBeApprovedIfCurationIsOff()
    {
        $user = factory('App\Models\User')->create(['curator' => 0]);

        putenv('FEATURE_CURATION_ENABLED=false');

        $service = new PageService(new TagService);

        $expected = 1;
        $actual = $service->shouldBeApproved($user, ['approved' => null]);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanTellIfPageShouldBeApprovedIfUserIsCurator()
    {
        $user = factory('App\Models\User')->create(['curator' => 1]);

        putenv('FEATURE_CURATION_ENABLED=true');

        $service = new PageService(new TagService);

        $expected = 1;
        $actual = $service->shouldBeApproved($user, ['approved' => null]);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanTellIfPageShouldBeApprovedIfDataHasApprovedTrue()
    {
        $user = factory('App\Models\User')->create(['curator' => 0]);

        putenv('FEATURE_CURATION_ENABLED=true');

        $page = factory('App\Models\Page')->create();

        $service = new PageService(new TagService);

        $expected = 1;
        $actual = $service->shouldBeApproved($user, ['approved' => 1], $page);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanTellIfPageShouldBeApprovedIfCurrentPageIsAlreadyApproved()
    {
        $user = factory('App\Models\User')->create(['curator' => 0]);

        putenv('FEATURE_CURATION_ENABLED=true');

        $page = factory('App\Models\Page')->create(['approved' => 1]);

        $service = new PageService(new TagService);

        $expected = 1;
        $actual = $service->shouldBeApproved($user, [], $page);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanTellThatPageShouldntBeApproved()
    {
        $user = factory('App\Models\User')->create(['curator' => 0]);

        putenv('FEATURE_CURATION_ENABLED=true');

        $page = factory('App\Models\Page')->create();

        $service = new PageService(new TagService);

        $expected = null;
        $actual = $service->shouldBeApproved($user, [], $page);

        $this->assertEquals($expected, $actual);
    }
}
