<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Badge;
use App\Models\UserBadge;
use App\Models\BadgeType;

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
     * Tests that a call to the badgeType relationship returns an
     * object of the BadgeType class
     *
     * @return void
     */
    public function testTypeRelationshipReturnsType()
    {
        $badgeType = factory(App\Models\BadgeType::class)->create();
        $badge = factory(App\Models\Badge::class)->create(['badge_type_id' => $badgeType->id]);

        $this->assertTrue($badge->type instanceof BadgeType);
    }
}
