<?php

namespace Tests\Acceptance\Controllers;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Page;
use App\Models\SuggestedEdit;

use App\Services\ModelServices\PageModelService;

class PageControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    public $user;

    /**
     * Test that a request to the route that shows a user an unapproved page
     * fails and returns a 404 response code (not found) when logged in as
     * a reader
     *
     * @return void
     */
    public function testItCanAccessAnyPageAsReader()
    {
        $this->logInAsUser();

        $page = factory('App\Models\Page')->create();

        $this->get(
            sprintf(
                '/p/%s/%s/%s',
                $page->chapter->category->slug,
                $page->chapter->slug,
                $page->slug
            )
        )
        ->see($page->title)
        ->assertResponseStatus(200);
    }

    /**
     * Test that a request to the route that shows a user the 'Create Page' Page
     * shows the 'Create Page' page and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanAccessCreatePagePage()
    {
        $this->logInAsUser();

        $this->get('/pages/create')->see('Create New Page')->assertResponseStatus(200);
    }

    /**
     * Test that a request to the route that shows a user the 'Suggest an Edit Page' Page
     * shows the 'Suggest an Edit Page' page and returns a 200 response code (OK) when
     * logged in as a standard user (not the page author or a curator)
     *
     * @return void
     */
    public function testItCanAccessSuggestEditPageAsReader()
    {
        $this->logInAsUser();

        $page = factory('App\Models\Page')->create();

        $this->get('/pages/edit/' . $page->id)
            ->see('Suggest an Edit')
            ->assertResponseStatus(200);
    }

    /**
     * Test that a request to the route that stores a new page works when
     * passed all available data from the creation form
     *
     * @return void
     */
    public function testItCanStoreNewPageWithAllData()
    {
        $this->logInAsUser();

        $chapter = factory('App\Models\Chapter')->create();

        $data = [
            '_token' => csrf_token(),
            'category_id' => $chapter->category->id,
            'chapter_id' => $chapter->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
            'last_draft_id' => null
        ];

        $this->post('/pages', $data)->assertResponseStatus(302);

        $this->seeInDatabase('pages', [
            'chapter_id' => $data['chapter_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
        ]);
    }

    /**
     * Test that a request to the route that stores a new page returns errors
     * when passed no data from the creation form
     *
     * @return void
     */
    public function testItCanNotStoreNewPageWithNoData()
    {
        $this->logInAsUser();

        $chapter = factory('App\Models\Chapter')->create();

        $this->post('/pages', [
            '_token' => csrf_token(),
        ])
        ->assertResponseStatus(302);

        $this->assertSessionHasErrors();
    }

    /**
     * Test that a request to the route that updates an existing page returns
     * errors when logged in as a curator and passed no available data from
     * the edit form
     *
     * @return void
     */
    public function testItCanNotUpdateAnExistingPageWithNoData()
    {
        $this->logInAsUser();

        $page = factory('App\Models\Page')->create();

        $data = [
            '_token' => csrf_token(),
        ];

        $this->put('/pages/' . $page->id, $data)->assertResponseStatus(302);

        $this->assertSessionHasErrors();
    }

    /**
     * Test that a request to the route that creates a suggested edit works when
     * logged in as a reader and is passed all available data from the edit
     * form
     *
     * @return void
     */
    public function testItCanCreateSuggestedEditAsReaderWithAllData()
    {
        $this->logInAsUser();

        $page = factory('App\Models\Page')->create();

        $data = [
            '_token' => csrf_token(),
            'category_id' => $page->chapter->category->id,
            'chapter_id' => $page->chapter->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
            'last_draft_id' => null
        ];

        $this->put('/pages/' . $page->id, $data)->assertResponseStatus(302);

        $this->seeInDatabase('suggested_edits', [
            'chapter_id' => $data['chapter_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
        ]);
    }

    /**
     * Test that a request to the route that creates a suggested edit works
     * errors when logged in as a reader and is passed no available data from
     * the edit form
     *
     * @return void
     */
    public function testItCanNotCreateSuggestedEditAsReaderWithNoData()
    {
        $this->logInAsUser();

        $page = factory('App\Models\Page')->create();

        $data = [
            '_token' => csrf_token(),
        ];

        $this->put('/pages/' . $page->id, $data)->assertResponseStatus(302);

        $this->assertSessionHasErrors();
    }

    /**
     * Test that a request to the route that destroys a page works when logged
     * in as a curator
     *
     * @return void
     */
    public function testItCanDestroyPageAsACurator()
    {
        $this->logInAsUser(['curator' => 1]);

        $page = factory('App\Models\Page')->create();

        $this->delete('/pages/' . $page->id)->assertResponseStatus(302);

        $this->dontSeeInDatabase('suggested_edits', [
            'id' => $page->id,
        ]);
    }

    /**
     * Test that a request to the route that destroys a page does not work when
     * logged in as an author
     *
     * @return void
     */
    public function testItCanNotDestroyPageAsUser()
    {
        $this->logInAsUser();

        $page = factory('App\Models\Page')->create();

        $this->delete('/pages/' . $page->id)->assertResponseStatus(401);

        $this->seeInDatabase('pages', [
            'id' => $page->id,
        ]);
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
