<?php

namespace Tests\Acceptance\Controllers;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    public $user;

    public function testItCanAccessShowUserPage()
    {
        $this->logInAsUser();

        $this->get('/u/' . $this->user->slug)
            ->see($this->user->name)
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
