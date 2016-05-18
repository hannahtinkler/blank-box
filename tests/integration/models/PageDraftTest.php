<?php

use App\Models\User;
use App\Models\Chapter;
use App\Models\PageDraft;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageDraftTest extends TestCase
{
    /**
     * Test that a call to the chapter relationship returns the chapter that
     * this page draft belongs to
     *
     * @return void
     */
    public function testChapterRelationshipReturnsChapter()
    {
        $pageDraft = factory(PageDraft::class)->create();

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
        $pageDraft = factory(PageDraft::class)->create();

        $this->assertTrue($pageDraft->creator instanceof User);
    }
}
