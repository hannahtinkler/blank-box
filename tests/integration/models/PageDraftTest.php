<?php

namespace Tests\Integration\Models;

use TestCase;

use App\Models\User;
use App\Models\Chapter;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageDraftTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test that a call to the chapter relationship returns the chapter that
     * this page draft belongs to
     *
     * @return void
     */
    public function testChapterRelationshipReturnsChapter()
    {
        $pageDraft = factory('App\Models\PageDraft')->create();

        $this->assertTrue($pageDraft->chapter instanceof Chapter);
    }
    
    /**
     * Test that a call to the creator relationship returns the creator that
     * this page draft belongs to
     *
     * @return void
     */
    public function testCreatorRelationshipReturnsCreator()
    {
        $pageDraft = factory('App\Models\PageDraft')->create();

        $this->assertTrue($pageDraft->creator instanceof User);
    }
}
