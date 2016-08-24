<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class RankControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    public $user;
    
    /**
     * Test that a request to the route that shows a user the 'Rankings' Page
     * and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanAccessRankPage()
    {
        $this->logInAsUser();

        $this->get('/u/' . $this->user->slug . '/rank')
            ->see('Rankings')
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
        $this->user = factory(App\Models\User::class)->create($overrides);
        $this->be($this->user);
    }
}
