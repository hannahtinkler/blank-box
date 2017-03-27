<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Tag;

use App\Services\TagService;

class TagServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetAllTags()
    {
        $tag1 = factory('App\Models\Tag')->create(['tag' => 'def']);
        $tag2 = factory('App\Models\Tag')->create(['tag' => 'abc']);

        $service = new TagService;

        $expected = [
            $tag2->toArray(),
            $tag1->toArray(),
        ];

        $actual = $service->getAll()->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItOnlyAddsNewTagsWhenStoringPageTags()
    {
        $page = factory('App\Models\Page')->create();
        
        factory('App\Models\Tag')->create(['tag' => 'def']);
        
        $service = new TagService;

        $service->store(
            $page,
            [
                'abc',
                'def',
            ]
        );

        $expected = [
            ['tag' => 'def'],
            ['tag' => 'abc'],
        ];

        $actual = Tag::select('tag')->get()->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItOnlyAddsTagsToPageWithStore()
    {
        $page = factory('App\Models\Page')->create();
        $tag = factory('App\Models\Tag')->create(['tag' => 'def']);
        
        $service = new TagService;

        $service->store(
            $page,
            [
                'def',
            ]
        );

        $this->seeInDatabase('page_tags', [
            'page_id' => $page->id,
            'tag_id' => $tag->id,
        ]);
    }
}
