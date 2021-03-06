<?php

namespace Tests\Acceptance\Controllers;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Page;
use App\Models\Category;

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

        factory('App\Models\Page')->create(['approved' => 1]);

        $this->get('/random')->assertResponseStatus(302);
    }

    public function testItSwitchesTheActiveCategoryForAUser()
    {
        $this->logInAsUser();

        $category = factory('App\Models\Category')->create();

        $this->get('/switchcategory/' . $category->id)
            ->assertResponseStatus(302);

        $expected = $category->id;
        $actual = session()->get('currentCategoryId');

        $this->assertEquals($expected, $actual);

        $expected = $this->user->default_category_id;
        $actual = session()->get('currentCategoryId');

        $this->assertEquals($expected, $actual);
    }

    public function testItShowsTheActiveCategoryForAUser()
    {
        $this->logInAsUser();

        $category = factory('App\Models\Category')->create();

        $this->get('/switchcategory/' . $category->id)
            ->assertResponseStatus(302);

        $this->get('/')
            ->see('<span class="text-mutedblock" title="You are currently exploring the '. $category->title .' category.');
    }

    public function testItCanAccessFeed()
    {
        $this->logInAsUser();

        $this->get('/')
            ->see('Page Title')
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
