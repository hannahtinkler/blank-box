<?php

use App\Models\PageTag;
use App\Models\Tag;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagTest extends TestCase
{
    /**
     * Test that a call to the pageTags relationship returns a collection
     * containing objects of the type 'PageTag'
     *
     * @return void
     */
    public function testPageTagsRelationshipReturnsPageTags()
    {
        $tag = factory(Tag::class)->create();
        factory(PageTag::class, 2)->create(['tag_id' => $tag->id]);

        $this->assertTrue($tag->pageTags->first() instanceof PageTag);
    }
}
