<?php

use App\Models\Chapter;
use App\Repositories\PageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChapterControllerTest extends TestCase
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
        'category_id',
        'title',
        'description',
        'order',
        'slug',
    );

    /**
     * Test that a request to the route that shows a user the 'Show Chapter' Page
     * shows the 'Show Chapter' page and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanAccessShowChapterPage()
    {
        $this->logInAsUser();

        $chapter = factory(App\Models\Chapter::class)->create();

        $this->get('/p/' . $chapter->category->slug . '/' . $chapter->slug)
            ->see($chapter->title)
            ->assertResponseStatus(200);
    }

    /**
     * Tests that a request to the route that returns a JSON array of chapter
     * information for a given category works and returns the expected data
     * @return void
     */
    public function testItCanReturnChaptersForAGivenCategory()
    {
        $this->logInAsUser();

        $chapter = factory(App\Models\Chapter::class)->create();

        $this->get('/ajax/data/chapters/' . $chapter->category->id)
            ->seeJson(['title' => $chapter->title]);
    }

    /**
     * Test that a call to the method that shows a user the 'Create Chapter' Page
     * shows the 'Create Chapter' page and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanAccessCreateChapterPage()
    {
        $this->logInAsUser();

        $this->get('/chapters/create')
            ->see('Create New Chapter')
            ->assertResponseStatus(200);
    }

    /**
     * Test that a call to the method that stores a new chapter works when
     * passed all available data from the creation form
     *
     * @return void
     */
    public function testItCanStoreNewChapterWithAllData()
    {
        $this->logInAsUser();

        $currentCount = Chapter::all()->count();

        $category = factory(App\Models\Category::class)->create();

        $this->post('/chapters', [
                '_token' => csrf_token(),
                'category_id' => $category->id,
                'title' => $this->faker->sentence,
                'description' => $this->faker->sentence,
                'content' => $this->faker->text,
            ])
            ->assertResponseStatus(302);

        $expectedCount = $currentCount + 1;
        $actualCount = Chapter::all()->count();

        $this->assertEquals($expectedCount, $actualCount);
    }

    /**
     * Test that a call to the method that stores a new chapter returns errors
     * when passed no data from the creation form
     *
     * @return void
     */
    public function testItCanNotStoreNewChapterWithNoData()
    {
        $this->logInAsUser();

        $category = factory(App\Models\Category::class)->create();

        $this->post('/chapters', [
                '_token' => csrf_token(),
            ])
            ->assertResponseStatus(302);
        
        $this->assertSessionHasErrors();
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
