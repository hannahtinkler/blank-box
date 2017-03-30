<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Page;

use App\Models\UserBadge;
use App\Models\SuggestedEdit;

use App\Services\SuggestedEditService;

class SuggestedEditServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetAllApprovedPages()
    {
        $edit = factory(SuggestedEdit::class)->create(['approved' => null]);

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
        $edit = factory(SuggestedEdit::class)->create(['approved' => null]);

        $service = new SuggestedEditService;

        $service->approve($edit->id);

        $expected = 1;
        $acual = SuggestedEdit::find($edit->id)->approved;

        $this->assertEquals($expected, $acual);
    }
    
    public function testItCanRejectSuggestedEdit()
    {
        $edit = factory(SuggestedEdit::class)->create(['approved' => null]);

        $service = new SuggestedEditService;

        $service->reject($edit->id);

        $expected = 0;
        $acual = SuggestedEdit::find($edit->id)->approved;

        $this->assertEquals($expected, $acual);
    }
}
