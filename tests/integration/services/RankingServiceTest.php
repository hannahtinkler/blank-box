<?php

namespace Tests\Integration\Services;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\UserService;
use App\Services\RankingService;

class RankingServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetAllRankings()
    {
        $user = factory('App\Models\User')->create();
        $page = factory('App\Models\Page')->create(['approved' => 1]);

        $service = new RankingService(new UserService);

        $expected = [
            $page->creator->name => [
                'slug' => $page->creator->slug,
                'rank' => 1,
                'score' => 3,
            ],
            $user->name => [
                'slug' => $user->slug,
                'rank' => 2,
                'score' => 0,
            ],
        ];

        $actual = $service->getAllRankings();

        $this->assertEquals($expected, $actual);
    }
}
