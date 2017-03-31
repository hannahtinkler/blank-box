<?php

namespace Tests\Integration\Services;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Page;

use App\Models\SuggestedEdit;

use App\Services\SuggestedEditService;

class SuggestedEditServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetAllApprovedPages()
    {
        $edit = factory('App\Models\SuggestedEdit')->create(['approved' => null]);

        $edit->tags = null;
        $edit->deleted_at = null;

        $service = new SuggestedEditService;

        $expected = [
            $edit->toArray()
        ];

        $actual = $service->getAllUnapproved()->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanApproveSuggestedEdit()
    {
        $edit = factory('App\Models\SuggestedEdit')->create(['approved' => null]);

        $service = new SuggestedEditService;

        $service->approve($edit->id);

        $this->seeInDatabase('suggested_edits', [
            'id' => $edit->id,
            'approved' => 1,
        ]);
    }
    
    public function testItCanRejectSuggestedEdit()
    {
        $edit = factory('App\Models\SuggestedEdit')->create(['approved' => null]);

        $service = new SuggestedEditService;

        $service->reject($edit->id);

        $this->seeInDatabase('suggested_edits', [
            'id' => $edit->id,
            'approved' => 0,
        ]);
    }
}
