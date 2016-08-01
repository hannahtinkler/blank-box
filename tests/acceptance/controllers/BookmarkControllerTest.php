<?php

use App\Models\Bookmark;
use App\Services\ModelServices\PageModelService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookmarkControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    public $user;

    public function testItCanAccessBookmarksPage()
    {
        $this->logInAsUser();

        $this->get('/u/' . $this->user->slug .'/bookmarks')
            ->see('Your Bookmarks')
            ->assertResponseStatus(200);
    }

    /**
     * Test that a request to the route that creates a bookmark works when
     * passed all available data, and returns sucess = true via json
     *
     * @return void
     */
    public function testItCanCreateBookmarkWithAllDAta()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create();

        $this->get('/u/' . $this->user->slug .'/bookmarks/create/' . $page->chapter->category->id . '/' . $page->chapter->id . '/' . $page->id)
            ->seeJson(['success' => true]);
    }

    /**
     * Test that a request to the route that creates a bookmark fails when
     * passed no available data, and returns a 404 error
     *
     * @return void
     */
    public function testItCanNotCreateBookmarkWithNoData()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create();

        $this->get('/u/' . $this->user->slug .'/bookmarks/create')
            ->assertResponseStatus(404);
    }

    /**
     * Test that a request to the route that deletes a bookmark works when
     * passed all available data, and returns sucess = true via json
     *
     * @return void
     */
    public function testItCanDeleteBookmarkWithAllDAta()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create();

        $this->get('/u/' . $this->user->slug .'/bookmarks/delete/' . $page->chapter->category->id . '/' . $page->chapter->id . '/' . $page->id)
            ->seeJson(['success' => true]);
    }

    /**
     * Test that a request to the route that deletes a bookmark fails when
     * passed no available data, and returns a 404 error
     *
     * @return void
     */
    public function testItCanNotDeleteBookmarkWithNoDAta()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create();

        $this->get('/u/' . $this->user->slug .'/bookmarks/delete')
            ->assertResponseStatus(404);
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
