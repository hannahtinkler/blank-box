<?php

use App\Models\Chapter;
use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    /**
     * Test that a call to the chapter relationship returns a collection
     * containing objects of the type 'Page'
     *
     * @return void
     */
    public function testChapterRelationshipReturnsChapter()
    {
        $category = factory(Category::class)->create();
        factory(Chapter::class, 2)->create(['category_id' => $category->id]);

        $this->assertTrue($category->chapters->first() instanceof Chapter);
    }
}
