<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\UserBadge;
use App\Models\BadgeGroup;

class BadgeTypeTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Tests that a call to the badgeGroups relationship returns a collection
     * object containing instances of the BadgeGroup class
     *
     * @return void
     */
    public function testBadgeGroupsRelationshipReturnsBadgeGroups()
    {
        $badgeType = factory(App\Models\BadgeType::class)->create();
        factory(App\Models\BadgeGroup::class, 2)->create(['badge_type_id' => $badgeType->id]);

        $this->assertTrue($badgeType->badgeGroups->first() instanceof BadgeGroup);
    }
}
