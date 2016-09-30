<?php

use App\Models\Page;
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

    public function testItSwitchesTheActiveCategoryForAUser()
    {
        $this->logInAsUser();

        $category = factory(App\Models\Category::class)->create();

        $this->get('/switchcategory/' . $category->id)
            ->assertResponseStatus(302);

        $expected = $category->id;
        $actual = \Session::get('currentCategoryId');

        $this->assertEquals($expected, $actual);

        $expected = $this->user->default_category_id;
        $actual = \Session::get('currentCategoryId');

        $this->assertEquals($expected, $actual);
    }

    public function testItShowsTheActiveCategoryForAUser()
    {
        $this->logInAsUser();

        $category = factory(App\Models\Category::class)->create();

        $this->get('/switchcategory/' . $category->id)
            ->assertResponseStatus(302);
        
        $this->get('/')
            ->see('<span class="text-mutedblock" title="You are currently exploring the '. $category->title .' category.');
    }

    public function testItCanAccessFeed()
    {
        $this->logInAsUser();

        $this->get('/')
            ->see('Black Box')
            ->assertResponseStatus(200);
    }

    public function testItCanAccessFeedWithDeletedResource()
    {
        $this->logInAsUser();

        $event = factory(App\Models\Category::class)->create();

        Page::where('id', $event->resource_id)->delete();

        $this->get('/')
            ->see('Black Box')
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
