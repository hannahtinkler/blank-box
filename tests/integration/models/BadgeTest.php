<?php

namespace Tests\Integration\Models;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

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
        $badge = factory('App\Models\Badge')->create();
        factory('App\Models\UserBadge', 2)->create(['badge_id' => $badge->id]);

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
        $badgeType = factory('App\Models\BadgeType')->create();
        $badge = factory('App\Models\Badge')->create(['badge_type_id' => $badgeType->id]);

        $this->assertTrue($badge->type instanceof BadgeType);
    }
}
