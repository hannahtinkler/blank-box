<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\User;
use App\Models\Badge;
use App\Models\UserBadge;

class UserBadgeTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Tests that a call to the user relationship returns an
     * object of the User class
     *
     * @return void
     */
    public function testUserRelationshipReturnsUser()
    {
        $user = factory(App\Models\User::class)->create();
        $userBadge = factory(App\Models\UserBadge::class)->create(['user_id' => $user->id]);

        $this->assertTrue($userBadge->user instanceof User);
    }

    /**
     * Tests that a call to the badge relationship returns an
     * object of the Badge class
     *
     * @return void
     */
    public function testBadgeRelationshipReturnsBadge()
    {
        $badge = factory(App\Models\Badge::class)->create();
        $userBadge = factory(App\Models\UserBadge::class)->create(['badge_id' => $badge->id]);

        $this->assertTrue($userBadge->badge instanceof Badge);
    }
}
