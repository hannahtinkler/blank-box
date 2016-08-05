<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class RelatedControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    public $user;
    
    public function testItCanAccessRelatedApiCall()
    {
        $this->logInAsUser();

        $this->get('/related/care%20pathway')
            ->seeJson(["title" => "Page: Putting a Care Pathway Live"])
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
