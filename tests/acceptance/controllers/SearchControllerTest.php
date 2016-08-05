<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    public $user;

    public function testItCanAccessSearchApiCall()
    {
        $this->logInAsUser();

        $this->get('/search/care%20pathway')
            ->seeJson(["title" => "Putting a Care Pathway Live"])
            ->assertResponseStatus(200);
    }

    public function testItCanAccessSearchResultsPage()
    {
        $this->logInAsUser();

        $this->get('/search/care%20pathway/results')
            ->see("Search Results")
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
