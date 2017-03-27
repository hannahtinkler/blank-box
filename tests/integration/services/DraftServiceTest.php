<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\DraftService;

class DraftServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanDeleteDraft()
    {
        $draft = factory('App\Models\PageDraft')->create();
        
        $service = new DraftService;

        $service->delete($draft->id);

        $this->dontSeeInDatabase('page_drafts', [
            'id' => $draft->id,
        ]);
    }
}
