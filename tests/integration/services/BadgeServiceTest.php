<?php

namespace Tests\Integration\Services;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\BadgeService;

class BadgeServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetBadgeById()
    {
        $service = new BadgeService;

        $expected = [
            'id' => '1',
            'badge_type_id' => '1',
            'name' => 'Pages Added: Rank 1',
            'description' => 'Earned by submitting 1 page',
            'image' => '/images/badges/workflows_bronze.png',
            'level' => '1',
            'metric_boundary' => '1',
            'created_at' => '2016-09-30 14:47:33',
            'updated_at' => '2016-09-30 14:47:33',
        ];

        $actual = $service->getById(1)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetBadgesByUserId()
    {
        $service = new BadgeService;

        factory('App\Models\UserBadge')->create(['badge_id' => 1, 'user_id' => 1]);

        $expected = [
            [
                'id' => '1',
                'badge_type_id' => '1',
                'name' => 'Pages Added: Rank 1',
                'description' => 'Earned by submitting 1 page',
                'image' => '/images/badges/workflows_bronze.png',
                'level' => '1',
                'metric_boundary' => '1',
                'created_at' => '2016-09-30 14:47:33',
                'updated_at' => '2016-09-30 14:47:33',
            ]
        ];

        $actual = $service->getByUserId(1)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetBestBadgeByUserId()
    {
        factory('App\Models\UserBadge')->create(['badge_id' => 2, 'user_id' => 1]);
        factory('App\Models\UserBadge')->create(['badge_id' => 3, 'user_id' => 1]);
        factory('App\Models\UserBadge')->create(['badge_id' => 4, 'user_id' => 1]);

        $service = new BadgeService;

        $expected = [
            'id' => '4',
            'badge_type_id' => '1',
            'name' => 'Pages Added: Rank 4',
            'description' => 'Earned by submitting 50 pages',
            'image' => '/images/badges/workflows_platinum.png',
            'level' => '4',
            'metric_boundary' => '50',
            'created_at' => '2016-09-30 14:47:33',
            'updated_at' => '2016-09-30 14:47:33',
        ];

        $actual = $service->getBestByUserId(1)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetNewlyEarnedBadgesByUserId()
    {
        $service = new BadgeService;

        $expected = [
            [
                'id' => 1,
                'badge_type_id' => 1,
                'name' => "Pages Added: Rank 1",
                'description' => "Earned by submitting 1 page",
                'image' => "/images/badges/workflows_bronze.png",
                'level' => 1,
                'metric_boundary' => 1,
                'created_at' => "2016-09-30 14:47:33",
                'updated_at' => "2016-09-30 14:47:33",
            ],
            [
                'id' => 2,
                'badge_type_id' => 1,
                'name' => "Pages Added: Rank 2",
                'description' => "Earned by submitting 10 pages",
                'image' => "/images/badges/workflows_silver.png",
                'level' => 2,
                'metric_boundary' => 10,
                'created_at' => "2016-09-30 14:47:33",
                'updated_at' => "2016-09-30 14:47:33",
            ],
            [
                'id' => 3,
                'badge_type_id' => 1,
                'name' => "Pages Added: Rank 3",
                'description' => "Earned by submitting 30 pages",
                'image' => "/images/badges/workflows_gold.png",
                'level' => 3,
                'metric_boundary' => 30,
                'created_at' => "2016-09-30 14:47:33",
                'updated_at' => "2016-09-30 14:47:33",
            ],
        ];

        $actual = $service->getNewByUserId(1, 'pagesSubmitted', 30)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanAddManyBadgesForUser()
    {
        $service = new BadgeService;

        $service->addManyForUser(1, [2, 3, 4]);

        $this->seeInDatabase('user_badges', [
            'user_id' => 1,
            'badge_id' => 2,
            'read' => 0,
        ]);

        $this->seeInDatabase('user_badges', [
            'user_id' => 1,
            'badge_id' => 3,
            'read' => 0,
        ]);

        $this->seeInDatabase('user_badges', [
            'user_id' => 1,
            'badge_id' => 4,
            'read' => 0,
        ]);
    }

    public function testItCanAddOneBadgeForUser()
    {
        $service = new BadgeService;

        $service->addOneForUser(1, 2);

        $this->seeInDatabase('user_badges', [
            'user_id' => 1,
            'badge_id' => 2,
            'read' => 0,
        ]);
    }

    public function testItCanMarkAllUnseenBadgesAsSeen()
    {
        $userBadge = factory('App\Models\UserBadge')->create([
            'read' => 0,
        ]);

        $service = new BadgeService;

        $service->markAllAsSeen($userBadge->user->id);

        $this->seeInDatabase('user_badges', [
            'id' => $userBadge->id,
            'read' => 1,
        ]);
    }

    public function testItCanTellIfUserHasBadge()
    {
        $userBadge = factory('App\Models\UserBadge')->create();

        $service = new BadgeService;

        $hasBadge = $service->userHasBadge($userBadge->user->id, $userBadge->badge_id);

        $this->assertTrue($hasBadge);
    }

    public function testItCanTellIfUserDoesntHaveBadge()
    {
        $userBadge = factory('App\Models\UserBadge')->create();

        $service = new BadgeService;

        $hasBadge = $service->userHasBadge(1, $userBadge->badge_id);

        $this->assertFalse($hasBadge);
    }

    public function testItCanGetAllBadges()
    {
        $service = new BadgeService;

        foreach ($service->getAll()->toArray() as $badge) {
            $this->assertBadgeFormat($badge);
        }
    }

    private function assertBadgeFormat($badge)
    {
        $this->assertArrayHasKey('id', $badge);
        $this->assertArrayHasKey('badge_type_id', $badge);
        $this->assertArrayHasKey('name', $badge);
        $this->assertArrayHasKey('description', $badge);
        $this->assertArrayHasKey('image', $badge);
        $this->assertArrayHasKey('level', $badge);
        $this->assertArrayHasKey('metric_boundary', $badge);
        $this->assertArrayHasKey('created_at', $badge);
        $this->assertArrayHasKey('updated_at', $badge);
    }
}
