<?php

namespace Tests\Integration\Models;

use TestCase;

use App\Models\Chapter;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Test that a call to the chapter relationship returns a collection
     * containing objects of the type 'Page'
     *
     * @return void
     */
    public function testChapterRelationshipReturnsChapter()
    {
        $category = factory('App\Models\Category')->create();
        factory('App\Models\Chapter', 2)->create(['category_id' => $category->id]);

        $this->assertTrue($category->chapters->first() instanceof Chapter);
    }
}
