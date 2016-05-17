<?php

use App\Models\Bookmark;
use App\Repositories\PageRepository;
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

        $this->get('/bookmarks')
            ->see('Your Bookmarks')
            ->assertResponseStatus(200);
    }

    public function testItCanCreateBookmarkWithAllDAta()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create();

        $this->get('/bookmarks/create/' . $page->chapter->category->id . '/' . $page->chapter->id . '/' . $page->id)
            ->seeJson(['success' => true]);
    }

    public function testItCanNotCreateBookmarkWithNoData()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create();

        $this->get('/bookmarks/create')
            ->assertResponseStatus(404);
    }

    public function testItCanDeleteBookmarkWithAllDAta()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create();

        $this->get('/bookmarks/delete/' . $page->chapter->category->id . '/' . $page->chapter->id . '/' . $page->id)
            ->seeJson(['success' => true]);
    }

    public function testItCanNotDeleteBookmarkWithNoDAta()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create();

        $this->get('/bookmarks/delete')
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
