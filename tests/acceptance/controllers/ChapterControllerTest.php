<?php

namespace Tests\Acceptance\Controllers;

use TestCase;

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
     * Test that a request to the route that shows a user the 'Show Chapter' Page
     * shows the 'Show Chapter' page and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanAccessShowChapterPage()
    {
        $this->logInAsUser();

        $chapter = factory('App\Models\Chapter')->create();

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

        $chapter = factory('App\Models\Chapter')->create();

        $this->get('/ajax/data/chapters/' . $chapter->category->id)
            ->seeJson(['title' => $chapter->title]);
    }

    /**
     * Test that a request to the route that shows a user the 'Create Chapter' Page
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
     * Test that a request to the route that stores a new chapter works when
     * passed all available data from the creation form
     *
     * @return void
     */
    public function testItCanStoreNewChapterWithAllData()
    {
        $this->logInAsUser();

        $category = factory('App\Models\Category')->create();

        $data = [
            '_token' => csrf_token(),
            'category_id' => $category->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
        ];

        $this->post('/chapters', $data)->assertResponseStatus(302);

        $this->seeInDatabase('chapters', [
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
        ]);
    }

    /**
     * Test that a request to the route that stores a new chapter returns errors
     * when passed no data from the creation form
     *
     * @return void
     */
    public function testItCanNotStoreNewChapterWithNoData()
    {
        $this->logInAsUser();

        $category = factory('App\Models\Category')->create();

        $this->post('/chapters', [
            '_token' => csrf_token(),
        ])
        ->assertResponseStatus(302);
        
        $this->assertSessionHasErrors();
    }

    /**
     * Test that a request to the route that updates an existing page works when
     * logged in as a curator and passed all available data from the edit
     * form
     *
     * @return void
     */
    public function testItCanUpdateAnExistinChapterAsCuratorWithAllData()
    {
        $this->logInAsUser(['curator' => 1]);

        $chapter = factory('App\Models\Chapter')->create();

        $data = [
            '_token' => csrf_token(),
            'category_id' => $chapter->category_id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
        ];

        $this->put('/chapters/' . $chapter->id, $data)->assertResponseStatus(302);

        $this->seeInDatabase('chapters', [
            'id' => $chapter->id,
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
        ]);
    }

    /**
     * Test that a request to the route that updates an existing chapter returns
     * errors when logged in as a curator and passed no available data from
     * the edit form
     *
     * @return void
     */
    public function testItCanNotUpdateAnExistingChapterAsCuratorWithNoData()
    {
        $this->logInAsUser(['curator' => 1]);

        $chapter = factory('App\Models\Chapter')->create();

        $data = [
            '_token' => csrf_token(),
        ];

        $this->put('/chapters/' . $chapter->id, $data)
            ->assertResponseStatus(302);
        
        $this->assertSessionHasErrors();
    }
    
    /**
     * Test that a request to the route that shows a user the 'Edit Chapter' Page
     * shows the 'Edit Chapter' page and returns a 200 response code (OK) when
     * logged in as a curator
     *
     * @return void
     */
    public function testItCanAccessEditChapterAsCurator()
    {
        $this->logInAsUser(['curator' => 1]);

        $chapter = factory('App\Models\Chapter')->create();

        $this->get('/chapters/edit/' . $chapter->id)
            ->see('Edit Chapter')
            ->assertResponseStatus(200);
    }

    /**
     * Test that a request to the route that shows a user the 'Edit Chapter' Page
     * shows the 'Edit Chapter' page and returns a 200 response code (OK) when
     * logged in as a curator
     *
     * @return void
     */
    public function testItCanNotAccessEditChapterAsReader()
    {
        $this->logInAsUser();

        $chapter = factory('App\Models\Chapter')->create();

        $this->get('/chapters/edit/' . $chapter->id)
            ->assertResponseStatus(401);
    }

    /**
     * Test that a request to the route that updates an existing chapter returns
     * errors when logged in as a reader/non-author/non-curator
     *
     * @return void
     */
    public function testItCanNotUpdateAnExistingChapterAsReader()
    {
        $this->logInAsUser();

        $chapter = factory('App\Models\Chapter')->create();

        $data = [
            '_token' => csrf_token(),
            'category_id' => $chapter->category_id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
        ];

        $this->put('/chapters/' . $chapter->id, $data)
            ->assertResponseStatus(401);
    }

    /**
     * Test that a request to the route that destroys a chapter works when
     * logged in as a curator
     *
     * @return void
     */
    public function testItCanNotDestroyChapterAsReader()
    {
        $this->logInAsUser();

        $chapter = factory('App\Models\Chapter')->create();

        $this->delete('/chapters/' . $chapter->id)
            ->assertResponseStatus(401);
    }

    /**
     * Test that a request to the route that destroys a chapter works when
     * logged in as a curator
     *
     * @return void
     */
    public function testItCanDestroyChapterAsCurator()
    {
        $this->logInAsUser(['curator' => 1]);

        $chapter = factory('App\Models\Chapter')->create();

        $this->delete('/chapters/' . $chapter->id)
            ->assertResponseStatus(302);
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
