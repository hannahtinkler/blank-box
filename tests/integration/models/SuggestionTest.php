<?php

use App\Models\Page;
use App\Models\Chapter;
use App\Models\Suggestion;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SuggestionTest extends TestCase
{
    public function testPageRelationshipReturnsPage()
    {
        $suggestion = factory(Suggestion::class)->create();

        $this->assertTrue($suggestion->page instanceof Page);
    }
}
