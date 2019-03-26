<?php

namespace Tests\Integration\Repositories;

use StdClass;
use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Repositories\UserRepository;

class UserRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetSearchResultUrl()
    {
        $user = factory('App\Models\User')->create();

        $expected = sprintf('/u/%s', $user->slug);

        $actual = $user->searchResultUrl;

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetSearchResultStringForNormalUser()
    {
        $user = factory('App\Models\User')->create();

        $expected = 'User: ' . $user->name;

        $actual = $user->searchResultString;

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetSearchResultStringForCurator()
    {
        $user = factory('App\Models\User')->create(['curator' => 1]);

        $expected = 'User: ' . $user->name . (env('FEATURE_CURATION_ENABLED') ? ' (Curator)' : '');

        $actual = $user->searchResultString;

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetSearchResultIcon()
    {
        $user = factory('App\Models\User')->create();

        $expected = '<i class="fa fa-user"></i>';

        $actual = $user->searchResultIcon;

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetCommunityData()
    {
        $user = factory('App\Models\User')->create();
        $badge = factory('App\Models\UserBadge')->create(['user_id' => $user->id]);

        $expected = [
            'rank' => 48,
            'total' => 0,
            'badgeCount' => 1,
            'bestBadge' => $badge->badge->name,
        ];

        $actual = $user->communityData;

        $this->assertInternalType('int', $expected['rank']);
        $this->assertEquals($expected['total'], $actual['total']);
        $this->assertEquals($expected['bestBadge'], $actual['bestBadge']);
        $this->assertEquals($expected['badgeCount'], $actual['badgeCount']);
    }

    public function testItCanGetSpecialistAreas()
    {
        $user = factory('App\Models\User')->create();

        $page1 = factory('App\Models\Page')->create([
            'created_by' => $user->id,
            'approved' => 1,
        ]);

        $page2 = factory('App\Models\Page')->create([
            'created_by' => $user->id,
            'approved' => 1,
        ]);

        factory('App\Models\Page')->create([
            'chapter_id' => $page1->chapter->id,
            'created_by' => $user->id,
            'approved' => 1,
        ]);

        factory('App\Models\SuggestedEdit')->create([
            'chapter_id' => $page1->chapter->id,
            'created_by' => $user->id,
            'approved' => 1,
        ]);

        factory('App\Models\Page')->create([
            'chapter_id' => $page2->chapter->id,
            'created_by' => $user->id,
            'approved' => 1,
        ]);

        $row1 = new StdClass;
        $row1->title = $page1->chapter->title;
        $row1->chapterSlug = $page1->chapter->slug;
        $row1->categorySlug = $page1->chapter->category->slug;
        $row1->total = 3;

        $row2 = new StdClass;
        $row2->title = $page2->chapter->title;
        $row2->chapterSlug = $page2->chapter->slug;
        $row2->categorySlug = $page2->chapter->category->slug;
        $row2->total = 2;

        $expected = [
            $row1,
            $row2,
        ];

        $actual = $user->specialistAreas;

        $this->assertEquals($expected, $actual);
    }
}
