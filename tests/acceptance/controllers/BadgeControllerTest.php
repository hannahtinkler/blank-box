<?php

namespace Tests\Acceptance\Controllers;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class BadgeControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    public $user;
    
    /**
     * Test that a request to the route that shows a user the 'Show Badge' Page
     * shows the 'Show Badge' page and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanAccessShowBadgePage()
    {
        $this->logInAsUser();

        $this->get('/u/' . $this->user->slug . '/badges')
            ->see($this->user->name . '\'s Badges')
            ->assertResponseStatus(200);
    }
    
    /**
     * Test that a request to the route that shows a user the 'Show Badge' Page
     * shows the 'Show Badge' page and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanAccessBadgeModal()
    {
        $this->logInAsUser();
        
        $userBadge = factory('App\Models\UserBadge')->create([
            'user_id' => $this->user->id,
            'badge_id' => 1,
        ]);

        $this->get('/ajax/modal/badges/' . $this->user->id . '/1')
            ->see($userBadge->badge->name)
            ->see($userBadge->badge->type->name)
            ->see('Level ' . $userBadge->badge->level)
            ->assertResponseStatus(200);
    }

    /**
     * Logs in a new user so that we can path successfully though
     * authentication
     *
     * @return void
     */
    public function logInAsUser($overrides = [])
    {
        $this->user = factory('App\Models\User')->create($overrides);
        $this->be($this->user);
    }
}
