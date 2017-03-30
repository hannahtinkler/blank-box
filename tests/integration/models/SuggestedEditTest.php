<?php

use App\Models\User;
use App\Models\Page;
use App\Models\Chapter;
use App\Models\SuggestedEdit;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class SuggestedEditTest extends TestCase
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
        $page = factory(SuggestedEdit::class)->create();
        $this->assertTrue($page->chapter instanceof Chapter);
    }

    /**
     * Tests that a call to the page relationship returns the page that
     * this page belongs to
     *
     * @return void
     */
    public function testPageRelationshipReturnsPage()
    {
        $page = factory(Page::class)->create();
        $edit = factory(SuggestedEdit::class)->create(['page_id' => $page->id]);

        $this->assertTrue($edit->page instanceof Page);
    }

    /**
     * Tests that a call to the creator relationship returns the user that
     * this page belongs to
     *
     * @return void
     */
    public function testCreatorRelationshipReturnsCreator()
    {
        $page = factory(SuggestedEdit::class)->create();
        $this->assertTrue($page->creator instanceof User);
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
