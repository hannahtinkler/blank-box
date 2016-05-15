<?php

use App\Models\User;
use App\Models\Chapter;
use App\Models\PageDraft;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageDraftTest extends TestCase
{
    public function testChapterRelationshipReturnsChapter()
    {
        $pageDraft = factory(PageDraft::class)->create();

        $this->assertTrue($pageDraft->chapter instanceof Chapter);
    }
    
    public function testCreatorRelationshipReturnsCreator()
    {
        $pageDraft = factory(PageDraft::class)->create();

        $this->assertTrue($pageDraft->creator instanceof User);
    }
}
