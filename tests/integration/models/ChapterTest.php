<?php

use App\Models\Chapter;
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
    
    /**
     * Tests that a query implementing the 'largestOrderValue' scope returns
     * the highest order value in the page table for a given category
     *
     * @return void
     */
    public function testTheLargestOrderValueQueryScope()
    {
        $category = factory(Category::class)->create();
        $page1 = factory(Chapter::class)->create(['category_id' => $category->id, 'order' => 5]);
        $page2 = factory(Chapter::class)->create(['category_id' => $category->id, 'order' => 25]);
        $page3 = factory(Chapter::class)->create(['category_id' => $category->id, 'order' => 15]);
        
        $expected = Chapter::find($page2->id)->toArray();
        $actual = Chapter::largestOrderValue($category->id)->toArray();

        $this->assertEquals($expected, $actual);
    }
    
    /**
     * Tests that a query implementing the 'findBySlug' scope returns a record
     * with the given slug
     *
     * @return void
     */
    public function testTheFindBySlugQueryScope()
    {
        $page = factory(Chapter::class)->create();
        
        $expected = Chapter::find($page->id)->toArray();
        $actual = Chapter::findBySlug($page->slug)->toArray();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method that returns the search result string
     * for a given record works as expected
     *
     * @return void
     */
    public function testSearchResultStringIsCorrect()
    {
        $chapter = factory(Chapter::class)->create();

        $expected = 'Chapter: ' . $chapter->title . ' - ' . substr($chapter->description, 0, 60) . '...';
        $actual = $chapter->searchResultString();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method that returns the search result url
     * for a given record works as expected
     *
     * @return void
     */
    public function testSearchResultUrlIsCorrect()
    {
        $chapter = factory(Chapter::class)->create();

        $expected = '/p/' . $chapter->category->slug . '/' . $chapter->slug;
        $actual = $chapter->searchResultUrl();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method that returns the search result icon
     * for a given record works as expected
     *
     * @return void
     */
    public function testSearchResultIconIsCorrect()
    {
        $chapter = factory(Chapter::class)->create();

        $expected = '<i class="fa fa-folder-open-o"></i>';
        $actual = $chapter->searchResultIcon();

        $this->assertEquals($expected, $actual);
    }
}
