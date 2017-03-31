<?php

namespace Tests\Integration\Models;

use TestCase;

use App\Models\PageTag;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test that a call to the pageTags relationship returns a collection
     * containing objects of the type 'PageTag'
     *
     * @return void
     */
    public function testPageTagsRelationshipReturnsPageTags()
    {
        $tag = factory('App\Models\Tag')->create();
        factory('App\Models\PageTag', 2)->create(['tag_id' => $tag->id]);

        $this->assertTrue($tag->pageTags->first() instanceof PageTag);
    }
}
