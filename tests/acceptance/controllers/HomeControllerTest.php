<?php

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    public $user;

    /**
     * Test that a request to the route that shows a user a random page works
     * and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanSendAUserToARandomPage()
    {
        $this->logInAsUser();

        $this->get('/random')
            ->assertResponseStatus(302);
    }

    /**
     * Test that a request to the route that approves a page awaiting curation
     * works and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItSwitchTheActiveCategoryForAUser()
    {
        $this->logInAsUser();

        $category = factory(App\Models\Category::class)->create();

        $this->get('/switchcategory/' . $category->id)
            ->assertResponseStatus(302);

        $expected = $category->id;
        $actual = \Session::get('currentCategoryId');

        $this->assertEquals($expected, $actual);
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
