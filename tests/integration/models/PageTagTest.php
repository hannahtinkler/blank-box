<?php

use App\Models\Tag;
use App\Models\Page;
use App\Models\PageTag;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageTagTest extends TestCase
{
    /**
     * Test that a call to the tag relationship returns an instance of the
     * 'Tag' class
     *
     * @return void
     */
    public function testTagRelationshipReturnsTag()
    {
        $tag = factory(Tag::class)->create();

        $pageTag = factory(PageTag::class)->create(['tag_id' => $tag->id]);

        $this->assertTrue($pageTag->tag instanceof Tag);
    }
 
    /*
     * Test that a call to the page relationship returns ain instance of the
     * 'Page' class
     *
     * @return void
     */
    public function testPageRelationshipReturnsPage()
    {
        $page = factory(Page::class)->create();

        $pageTag = factory(PageTag::class)->create(['page_id' => $page->id]);

        $this->assertTrue($pageTag->page instanceof Page);
    }
}
