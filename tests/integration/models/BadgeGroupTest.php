<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Badge;
use App\Models\BadgeType;
use App\Models\BadgeGroup;

class BadgeGroupTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Tests that a call to the badges relationship returns a collection
     * object containing instances of the Badge class
     *
     * @return void
     */
    public function testBadgesRelationshipReturnsBadges()
    {
        $badgeGroup = factory(App\Models\BadgeGroup::class)->create();
        factory(App\Models\Badge::class, 2)->create(['badge_group_id' => $badgeGroup->id]);

        $this->assertTrue($badgeGroup->badges->first() instanceof Badge);
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
        $badgeGroup = factory(App\Models\BadgeGroup::class)->create(['badge_type_id' => $badgeType->id]);

        $this->assertTrue($badgeGroup->type instanceof BadgeType);
    }
}
