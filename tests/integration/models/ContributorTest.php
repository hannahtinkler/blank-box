<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\User;
use App\Models\Contributor;

class ContributorTest extends TestCase
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
        $contributor = factory(App\Models\Contributor::class)->create(['user_id' => $user->id]);

        $this->assertTrue($contributor->user instanceof User);
    }
}
