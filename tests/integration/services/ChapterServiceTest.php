<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\ChapterService;

class ChapterServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetChapterById()
    {
        $chapter = factory('App\Models\Chapter')->create();

        $service = new ChapterService;

        $expected = $chapter->toArray();

        $actual = $service->getById($chapter->id)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetChapterBySlug()
    {
        $chapter = factory('App\Models\Chapter')->create();
        
        $service = new ChapterService;

        $expected = $chapter->toArray();

        $actual = $service->getBySlug($chapter->slug)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetChaptersByCategoryId()
    {
        $chapter = factory('App\Models\Chapter')->create();

        $service = new ChapterService;

        $expected = [$chapter->toArray()];

        $actual = $service->getByCategoryId($chapter->category_id)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetAllChapters()
    {
        $chapter = factory('App\Models\Chapter')->create(['title' => 'AAA']);

        $service = new ChapterService;

        $expected = [
            $chapter->toArray(),
            [
                'id' => 1,
                'category_id' => 1,
                'title' => "Sample",
                'description' => "Sample pages go here.",
                'order' => 1,
                'slug' => "sample",
                'created_at' => "2017-03-30 13:30:52",
                'updated_at' => "2017-03-30 13:30:52",
            ],
        ];

        $actual = $service->getAll()->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanStoreNewChapter()
    {
        $service = new ChapterService;

        $expected = [
            'category_id' => 999,
            'title' => 'Category 999',
            'description' => 'An emergency category!',
            'slug' => 'category-999',
            'order' => 0,
        ];

        $actual = $service->store([
            'category_id' => 999,
            'title' => 'Category 999',
            'description' => 'An emergency category!',
        ])->toArray();

        unset($actual['id']);
        unset($actual['created_at']);
        unset($actual['updated_at']);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanUpdateNewChapter()
    {
        $chapter = factory('App\Models\Chapter')->create();

        $service = new ChapterService;

        $expected = [
            'id' => $chapter->id,
            'category_id' => 999,
            'title' => 'Category 999',
            'description' => 'An emergency category!',
            'slug' => 'category-999',
            'order' => $chapter->order,
            'created_at' => $chapter->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $chapter->updated_at->format('Y-m-d H:i:s'),
        ];

        $actual = $service->update(
            $chapter,
            [
                'category_id' => 999,
                'title' => 'Category 999',
                'description' => 'An emergency category!',
            ]
        )->toArray();

        $this->assertEquals($expected, $actual);
    }
}
