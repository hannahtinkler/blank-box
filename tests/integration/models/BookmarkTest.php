<?php

use App\Models\Page;
use App\Models\Chapter;
use App\Models\Category;
use App\Models\Bookmark;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookmarkTest extends TestCase
{
    public function testCategoryRelationshipReturnsCategory()
    {
        $bookmark = factory(Bookmark::class)->create();

        $this->assertTrue($bookmark->category instanceof Category);
    }

    public function testChapterRelationshipReturnsChapter()
    {
        $bookmark = factory(Bookmark::class)->create();

        $this->assertTrue($bookmark->chapter instanceof Chapter);
    }

    public function testPageRelationshipReturnsPage()
    {
        $bookmark = factory(Bookmark::class)->create();

        $this->assertTrue($bookmark->page instanceof Page);
    }
}
