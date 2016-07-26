<?php
use App\Models\Page;
use App\Models\SuggestedEdit;

use App\Services\ModelServices\PageModelService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageControllerTest extends TestCase
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
        'chapter_id',
        'title',
        'description',
        'content',
        'created_by'
    );

    /**
     * Test that a request to the route that shows a user an approved page
     * works and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanAccessApprovedPage()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create(['approved' => true]);

        $this->get('/p/' . $page->chapter->category->slug . '/' . $page->chapter->slug . '/' . $page->slug)
            ->see($page->title)
            ->assertResponseStatus(200);
    }

    /**
     * Test that a request to the route that shows a user an unapproved page
     * fails and returns a 404 response code (not found) when logged in as
     * a reader
     *
     * @return void
     */
    public function testItCanNotAccessUnapprovedPageAsReader()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create();

        $this->get('/p/' . $page->chapter->category->slug . '/' . $page->chapter->slug . '/' . $page->slug)
            ->assertResponseStatus(401);
    }

    /**
     * Test that a request to the route that shows a user an unapproved page
     * works and returns a 200 response code (OK) when logged in as the author
     *
     * @return void
     */
    public function testItCanAccessUnapprovedPageAsAuthor()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create(['created_by' => $this->user->id]);

        $this->get('/p/' . $page->chapter->category->slug . '/' . $page->chapter->slug . '/' . $page->slug)
            ->see($page->title)
            ->assertResponseStatus(200);
    }

    /**
     * Test that a request to the route that shows a user an unapproved page
     * works and returns a 200 response code (OK) when logged in as a
     * curator
     *
     * @return void
     */
    public function testItCanAccessUnapprovedPageAsCurator()
    {
        $this->logInAsUser(['curator' => true]);

        $page = factory(App\Models\Page::class)->create();

        $this->get('/p/' . $page->chapter->category->slug . '/' . $page->chapter->slug . '/' . $page->slug)
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

        $this->get('/pages/create')
            ->see('Create New Page')
            ->assertResponseStatus(200);
    }

    /**
     * Test that a request to the route that shows a user the 'Edit Page' Page
     * shows the 'Edit Page' page and returns a 200 response code (OK) when
     * logged in as a curator
     *
     * @return void
     */
    public function testItCanAccessEditPageAsCurator()
    {
        $this->logInAsUser(['curator' => true]);

        $page = factory(App\Models\Page::class)->create();

        $this->get('/pages/edit/' . $page->id)
            ->see('Edit Page')
            ->assertResponseStatus(200);
    }

    /**
     * Test that a request to the route that shows a user the 'Edit Page' Page
     * shows the 'Edit Page' page and returns a 200 response code (OK) when
     * logged in as the author of the page
     *
     * @return void
     */
    public function testItCanAccessEditPageAsAuthor()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create(['created_by' => $this->user->id]);

        $this->get('/pages/edit/' . $page->id)
            ->see('Edit Page')
            ->assertResponseStatus(200);
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

        $page = factory(App\Models\Page::class)->create();

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

        $currentCount = Page::all()->count();

        $chapter = factory(App\Models\Chapter::class)->create();

        $this->post('/pages', [
                '_token' => csrf_token(),
                'category_id' => $chapter->category->id,
                'chapter_id' => $chapter->id,
                'title' => $this->faker->sentence,
                'description' => $this->faker->sentence,
                'content' => $this->faker->text,
                'last_draft_id' => null
            ])
            ->assertResponseStatus(302);

        $expected = $currentCount + 1;
        $actual = Page::all()->count();

        $this->assertEquals($expected, $actual);
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

        $chapter = factory(App\Models\Chapter::class)->create();

        $this->post('/pages', [
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
    public function testItCanUpdateAnExistingPageAsCuratorWithAllData()
    {
        $this->logInAsUser(['curator' => true]);

        $page = factory(App\Models\Page::class)->create();

        $data = [
            '_token' => csrf_token(),
            'category_id' => $page->chapter->category->id,
            'chapter_id' => $page->chapter->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
            'last_draft_id' => null
        ];

        $this->put('/pages/' . $page->id, $data)
            ->assertResponseStatus(302);

        $expected = $data;
        $expected['created_by'] = $page->created_by;

        $actual = Page::find($page->id)->toArray();

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
    }

    /**
     * Test that a request to the route that updates an existing page returns
     * errors when logged in as a curator and passed no available data from
     * the edit form
     *
     * @return void
     */
    public function testItCanNotUpdateAnExistingPageAsCuratorWithNoData()
    {
        $this->logInAsUser(['curator' => true]);

        $page = factory(App\Models\Page::class)->create();

        $data = [
            '_token' => csrf_token(),
        ];

        $this->put('/pages/' . $page->id, $data)
            ->assertResponseStatus(302);
        
        $this->assertSessionHasErrors();
    }

    /**
     * Test that a request to the route that updates an existing page works
     * when logged in as the page author and passed all available data from
     * the edit form
     *
     * @return void
     */
    public function testItCanUpdateAnExistingPageAsAuthorWithAllData()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create(['created_by' => $this->user->id]);

        $data = [
            '_token' => csrf_token(),
            'category_id' => $page->chapter->category->id,
            'chapter_id' => $page->chapter->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
            'last_draft_id' => null
        ];

        $this->put('/pages/' . $page->id, $data)
            ->assertResponseStatus(302);

        $expected = $data;
        $expected['created_by'] = $page->created_by;

        $actual = Page::find($page->id)->toArray();

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
    }

    /**
     * Test that a request to the route that updates an existing page returns
     * errors when logged in as a the page author and passed no available
     * data from the edit form
     *
     * @return void
     */
    public function testItCanUpdateAnExistingPageAsAuthorWithNoData()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create(['created_by' => $this->user->id]);

        $data = [
            '_token' => csrf_token(),
        ];

        $this->put('/pages/' . $page->id, $data)
            ->assertResponseStatus(302);
        
        $this->assertSessionHasErrors();
    }

    /**
     * Test that a request to the route that updates an existing page returns
     * errors when logged in as a reader/non-author/non-curator
     *
     * @return void
     */
    public function testItCanNotUpdateAnExistingPageAsReader()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create();

        $data = [
            '_token' => csrf_token(),
        ];

        $this->put('/pages/' . $page->id, $data)
            ->assertResponseStatus(302);
        
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

        $page = factory(App\Models\Page::class)->create();

        $data = [
            '_token' => csrf_token(),
            'category_id' => $page->chapter->category->id,
            'chapter_id' => $page->chapter->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
            'last_draft_id' => null
        ];

        $this->put('/pages/' . $page->id, $data)
            ->assertResponseStatus(302);

        $expected = $data;
        $expected['created_by'] = $this->user->id;

        $actual = SuggestedEdit::where('page_id', $page->id)->first()->toArray();

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
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

        $page = factory(App\Models\Page::class)->create();

        $data = [
            '_token' => csrf_token(),
        ];

        $this->put('/pages/' . $page->id, $data)
            ->assertResponseStatus(302);
        
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
        $this->logInAsUser(['curator' => true]);

        $page = factory(App\Models\Page::class)->create();

        $this->delete('/pages/' . $page->id)
            ->assertResponseStatus(302);

        $lookup = Page::find($page->id);

        $this->assertNull($lookup);
    }

    /**
     * Test that a request to the route that destroys a page does not work when
     * logged in as an author
     *
     * @return void
     */
    public function testItCanNotDestroyPageAsAnAuthor()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create(['created_by' => $this->user->id]);

        $this->delete('/pages/' . $page->id)
            ->assertResponseStatus(401);
    }

    /**
     * Test that a request to the route that destroys a page does not work when
     * logged in as a reader
     *
     * @return void
     */
    public function testItCanNotDestroyPageAsAReader()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create();

        $this->delete('/pages/' . $page->id)
            ->assertResponseStatus(401);
    }

    public function testItCanAccessTheLatestPagesPage()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create();

        $this->get('/pages/latestupdates')
            ->assertResponseStatus(200)
            ->see("Latest Updated Pages:");
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
