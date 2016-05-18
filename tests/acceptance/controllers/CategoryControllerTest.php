<?php

use App\Models\Category;
use App\Repositories\PageRepository;
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
     * An array of fields which should be used for comparison purposes when
     * using assertEquals()
     *
     * @var array
     */
    public $comparableFields = array(
        'title',
        'description',
        'order',
        'slug',
    );

    /**
     * Test that a request to the route that shows a user the 'Show Category' Page
     * shows the 'Show Category' page and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanAccessShowCategoryPage()
    {
        $this->logInAsUser();

        $category = factory(App\Models\Category::class)->create();

        $this->get('/p/' . $category->slug)
            ->see($category->title)
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
