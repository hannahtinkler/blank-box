<?php

namespace Tests\Integration\Models;

use TestCase;

use App\Models\Page;
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
        $chapter = factory('App\Models\Chapter')->create();

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
        $chapter = factory('App\Models\Chapter')->create();

        $overrides = [
            'chapter_id' => $chapter->id,
            'approved' => 1
        ];

        factory('App\Models\Page')->create($overrides);
        factory('App\Models\Page')->create($overrides);

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
        $chapter = factory('App\Models\Chapter')->create();
        factory('App\Models\Bookmark')->create(['chapter_id' => $chapter->id]);

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
        $chapter = factory('App\Models\Chapter')->create();

        factory('App\Models\Page')->create(['chapter_id' => $chapter->id, 'approved' => 1]);
        factory('App\Models\Page')->create(['chapter_id' => $chapter->id, 'approved' => 0]);

        $this->assertCount(1, $chapter->approvedPages);
    }
}
