<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Badge;
use App\Models\UserBadge;
use App\Models\BadgeGroup;

class BadgeTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Tests that a call to the badges relationship returns a collection
     * object containing instances of the Badge class
     *
     * @return void
     */
    public function testUserBadgesRelationshipReturnsUserBadges()
    {
        $badge = factory(App\Models\Badge::class)->create();
        factory(App\Models\UserBadge::class, 2)->create(['badge_id' => $badge->id]);

        $this->assertTrue($badge->userBadges->first() instanceof UserBadge);
    }

    /**
     * Tests that a call to the badgeGroup relationship returns an
     * object of the BadgeGroup class
     *
     * @return void
     */
    public function testBadgeGroupRelationshipReturnsBadgeGroup()
    {
        $badgeGroup = factory(App\Models\BadgeGroup::class)->create();
        $badge = factory(App\Models\Badge::class)->create(['badge_group_id' => $badgeGroup->id]);

        $this->assertTrue($badge->badgeGroup instanceof BadgeGroup);
    }
}
