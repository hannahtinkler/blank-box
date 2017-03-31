<?php

namespace Tests\Integration\Models;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Badge;

class BadgeTypeTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Tests that a call to the badgeBadges relationship returns a collection
     * object containing instances of the Badge class
     *
     * @return void
     */
    public function testBadgesRelationshipReturnsBadges()
    {
        $badgeType = factory('App\Models\BadgeType')->create();

        factory('App\Models\Badge', 2)->create(['badge_type_id' => $badgeType->id]);

        $this->assertTrue($badgeType->badges->first() instanceof Badge);
    }
}
