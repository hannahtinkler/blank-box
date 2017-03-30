<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\PageDraftService;

class PageDraftServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetDraftById()
    {
        $draft = factory('App\Models\PageDraft')->create();

        $draft->approved = null;
        
        $service = new PageDraftService;

        $expected = $draft->toArray();

        $actual = $service->getById($draft->id)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetAllDraftsForUser()
    {
        $user = factory('App\Models\User')->create();
        $draft = factory('App\Models\PageDraft')->create(['created_by' => $user->id]);

        $draft->approved = null;
        
        $service = new PageDraftService;

        $expected = [
            $draft->toArray()
        ];

        $actual = $service->getAllByUserId($user->id)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanStoreDraftWithData()
    {
        $user = factory('App\Models\User')->create();
        
        $service = new PageDraftService;

        $actual = $service->store($user->id, [
            'chapter_id' => 42,
            'title' => 'An Exciting Draft',
            'description' => 'Some exciting description',
            'content' => 'Some exciting content',
        ])->toArray();

        $this->seeInDatabase('page_drafts', [
            'chapter_id' => 42,
            'title' => 'An Exciting Draft',
            'description' => 'Some exciting description',
            'content' => 'Some exciting content',
        ]);
    }

    public function testItCanStoreDraftWithoutData()
    {
        $user = factory('App\Models\User')->create();
        
        $service = new PageDraftService;

        $actual = $service->store($user->id, [])->toArray();

        $this->seeInDatabase('page_drafts', [
            'chapter_id' => null,
            'title' => null,
            'description' => null,
            'content' => null,
            'created_by' => $user->id,
        ]);
    }

    public function testItCanUpdateDraft()
    {
        $draft = factory('App\Models\PageDraft')->create();

        $service = new PageDraftService;

        $expected = [
            'id' => $draft->id,
            'chapter_id' => 42,
            'title' => 'An Exciting Draft',
            'description' => 'Some exciting description',
            'content' => 'Some exciting content',
            'approved' => null,
            'created_by' => $draft->created_by,
        ];

        $actual = $service->update($draft->id, [
            'chapter_id' => 42,
            'title' => 'An Exciting Draft',
            'description' => 'Some exciting description',
            'content' => 'Some exciting content',
        ])->toArray();

        unset($actual['created_at']);
        unset($actual['updated_at']);
        unset($actual['deleted_at']);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanDeleteDraft()
    {
        $draft = factory('App\Models\PageDraft')->create();
        
        $service = new PageDraftService;

        $service->delete($draft->id);

        $this->dontSeeInDatabase('page_drafts', [
            'id' => $draft->id,
        ]);
    }
}
