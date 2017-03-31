<?php

namespace Tests\Integration\Models;

use TestCase;

use App\Models\Page;
use App\Models\Chapter;
use App\Models\Category;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookmarkTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Test that a call to the category relationship returns the category that
     * this bookmark belongs to
     *
     * @return void
     */
    public function testCategoryRelationshipReturnsCategory()
    {
        $bookmark = factory('App\Models\Bookmark')->create();

        $this->assertTrue($bookmark->category instanceof Category);
    }

    /**
     * Test that a call to the chapter relationship returns the chapter that
     * this bookmark belongs to
     *
     * @return void
     */
    public function testChapterRelationshipReturnsChapter()
    {
        $bookmark = factory('App\Models\Bookmark')->create();

        $this->assertTrue($bookmark->chapter instanceof Chapter);
    }

    /**
     * Test that a call to the page relationship returns the page that
     * this bookmark belongs to
     *
     * @return void
     */
    public function testPageRelationshipReturnsPage()
    {
        $bookmark = factory('App\Models\Bookmark')->create();

        $this->assertTrue($bookmark->page instanceof Page);
    }
}
