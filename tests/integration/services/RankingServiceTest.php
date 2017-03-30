<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\UserService;
use App\Services\RankingService;

class RankingServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetAllRankings()
    {
        $page = factory('App\Models\Page')->create(['approved' => true]);

        $service = new RankingService(new UserService);

        $expected = [
            $page->creator->name => [
                'slug' => $page->creator->slug,
                'rank' => 1,
                'score' => 3,
            ],
            'Sarina Lowe' => [
                'slug' => "sarina-lowe",
                'rank' => 2,
                'score' => 0,
            ],
        ];

        $actual = $service->getAllRankings();

        $this->assertEquals($expected, $actual);
    }
}
