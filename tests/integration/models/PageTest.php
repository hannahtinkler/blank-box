<?php

use App\Models\Page;
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
        $page = factory(Page::class)->create();
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
        $page = factory(Page::class)->create();
        factory(Bookmark::class)->create(['page_id' => $page->id, 'user_id' => $user->id]);

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
        $page = factory(Page::class)->create();
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
        $page = factory(Page::class)->create();
        factory(PageTag::class, 3)->create(['page_id' => $page->id]);

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
        $user = factory(User::class)->create($overrides);
        Auth::login($user);

        return $user;
    }
}
