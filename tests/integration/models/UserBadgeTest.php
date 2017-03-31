<?php

namespace Tests\Integration\Models;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\User;
use App\Models\Badge;

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
        $user = factory('App\Models\User')->create();
        $userBadge = factory('App\Models\UserBadge')->create(['user_id' => $user->id]);

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
        $badge = factory('App\Models\Badge')->create();
        $userBadge = factory('App\Models\UserBadge')->create(['badge_id' => $badge->id]);

        $this->assertTrue($userBadge->badge instanceof Badge);
    }
}
