<?php

namespace Tests\Acceptance\Controllers;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    public $user;

    /**
     * Test that a request to the route that shows a user the 'Show Category' Page
     * shows the 'Show Category' page and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanAccessShowCategoryPage()
    {
        $this->logInAsUser();

        $chapter = factory('App\Models\Chapter')->create();

        $this->get('/p/' . $chapter->category->slug)->see($chapter->category->title)
        ->see($chapter->title)
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
