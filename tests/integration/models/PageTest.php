<?php

namespace Tests\Integration\Models;

use Auth;
use TestCase;

use App\Models\User;
use App\Models\PageTag;
use App\Models\Chapter;
use App\Models\Bookmark;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Tests that a call to the chapter relationship returns the chapter that
     * this page belongs to
     *
     * @return void
     */
    public function testChapterRelationshipReturnsChapter()
    {
        $page = factory('App\Models\Page')->create();
        $this->assertTrue($page->chapter instanceof Chapter);
    }

    /**
     * Tests that a call to the bookmark relationship returns the bookmark that
     * this page belongs to
     *
     * @return void
     */
    public function testBookmarksRelationshipReturnsBookmark()
    {
        $user = $this->createAndLoginAUser();
        $page = factory('App\Models\Page')->create();
        factory('App\Models\Bookmark')->create(['page_id' => $page->id, 'user_id' => $user->id]);

        $this->assertTrue($page->bookmark instanceof Bookmark);
    }

    /**
     * Tests that a call to the creator relationship returns the user that
     * this page belongs to
     *
     * @return void
     */
    public function testCreatorRelationshipReturnsCreator()
    {
        $page = factory('App\Models\Page')->create();
        $this->assertTrue($page->creator instanceof User);
    }

    /**
     * Tests that a call to the pageTags relationship returns a colleaction of
     * PageTags
     *
     * @return void
     */
    public function testPageTagsRelationshipReturnsPageTags()
    {
        $page = factory('App\Models\Page')->create();
        factory('App\Models\PageTag', 3)->create(['page_id' => $page->id]);

        $this->assertTrue($page->pageTags->first() instanceof PageTag);
    }

    /**
     * Tests that a call to the method that returns the search result string
     * for a given record works as expected
     *
     * @return void
     */
    public function createAndLoginAUser($overrides = [])
    {
        $user = factory('App\Models\User')->create($overrides);
        Auth::login($user);

        return $user;
    }
}
