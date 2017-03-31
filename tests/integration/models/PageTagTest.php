<?php

namespace Tests\Integration\Models;

use TestCase;

use App\Models\Tag;
use App\Models\Page;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageTagTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test that a call to the tag relationship returns an instance of the
     * 'Tag' class
     *
     * @return void
     */
    public function testTagRelationshipReturnsTag()
    {
        $tag = factory('App\Models\Tag')->create();

        $pageTag = factory('App\Models\PageTag')->create(['tag_id' => $tag->id]);

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
        $page = factory('App\Models\Page')->create();

        $pageTag = factory('App\Models\PageTag')->create(['page_id' => $page->id]);

        $this->assertTrue($pageTag->page instanceof Page);
    }
}
