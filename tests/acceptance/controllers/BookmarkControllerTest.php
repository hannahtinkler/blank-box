<?php

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

        $page = factory('App\Models\Page')->create();

        $this->get(
            sprintf(
                '/u/%s/bookmarks/create/%s/%s/%s',
                $this->user->slug,
                $page->chapter->category->id,
                $page->chapter->id,
                $page->id
            )
        )->seeJson(['success' => true]);

        $this->seeInDatabase('bookmarks', [
            'user_id' => $this->user->id,
            'category_id' => $page->chapter->category->id,
            'chapter_id' => $page->chapter->id,
            'page_id' => $page->id
        ]);
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

        $page = factory('App\Models\Page')->create();

        $this->get('/u/' . $this->user->slug .'/bookmarks/create')->assertResponseStatus(404);

        $this->dontSeeInDatabase('bookmarks', [
            'user_id' => $this->user->id,
            'category_id' => $page->chapter->category->id,
            'chapter_id' => $page->chapter->id,
            'page_id' => $page->id
        ]);
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

        $page = factory('App\Models\Page')->create();

        $this->get(
            sprintf(
                '/u/%s/bookmarks/delete/%s/%s/%s',
                $this->user->slug,
                $page->chapter->category->id,
                $page->chapter->id,
                $page->id
            )
        )->seeJson(['success' => true]);

        $this->dontSeeInDatabase('bookmarks', [
            'user_id' => $this->user->id,
            'category_id' => $page->chapter->category->id,
            'chapter_id' => $page->chapter->id,
            'page_id' => $page->id
        ]);
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

        $this->get('/u/' . $this->user->slug .'/bookmarks/delete')->assertResponseStatus(404);
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
