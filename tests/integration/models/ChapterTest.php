<?php

use App\Models\Page;
use App\Models\Chapter;
use App\Models\Category;
use App\Models\Bookmark;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChapterTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test that a call to the category relationship returns the category that
     * this chapter belongs to
     *
     * @return void
     */
    public function testCategoryRelationshipReturnsCategory()
    {
        $chapter = factory(Chapter::class)->create();

        $this->assertTrue($chapter->category instanceof Category);
    }
    /**
     * Test that a call to the chapter relationship returns a collection
     * object containing instances of the Page class
     *
     * @return void
     */
    public function testPagesRelationshipReturnsPages()
    {
        $chapter = factory(Chapter::class)->create();

        $overrides = [
            'chapter_id' => $chapter->id,
            'approved' => true
        ];
        
        factory(Page::class)->create($overrides);
        factory(Page::class)->create($overrides);

        $this->assertTrue($chapter->pages->first() instanceof Page);
    }
    /**
     * Test that a call to the bookmark relationship returns the bookmark that
     * this chapter belongs to
     *
     * @return void
     */
    public function testBookmarkRelationshipReturnsBookmark()
    {
        $chapter = factory(Chapter::class)->create();
        factory(Bookmark::class)->create(['chapter_id' => $chapter->id]);

        $this->assertTrue($chapter->bookmark instanceof Bookmark);
    }

    /**
     * Tests that a call to the approvedPages relationship returns only
     * approved pages
     *
     * @return void
     */
    public function testApprovedPagesRelationshipReturnsApprovedPages()
    {
        $chapter = factory(Chapter::class)->create();
        factory(Page::class)->create(['chapter_id' => $chapter->id, 'approved' => true]);
        factory(Page::class)->create(['chapter_id' => $chapter->id, 'approved' => false]);

        $this->assertCount(1, $chapter->approvedPages);
    }
}
