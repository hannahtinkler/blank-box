<?php

namespace Tests\Integration\Services;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Bookmark;
use App\Services\BookmarkService;

class BookmarkServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetBookmarksByUserSlug()
    {
        $bookmark1 = factory('App\Models\Bookmark')->create([
            'user_id' => 1,
        ]);

        $bookmark2 = factory('App\Models\Bookmark')->create([
            'user_id' => 1,
        ]);

        $service = new BookmarkService;

        $expected = [
            [
                'id' => $bookmark1->id,
                'user_id' => 1,
                'category_id' => $bookmark1->category_id,
                'chapter_id' => $bookmark1->chapter_id,
                'page_id' => $bookmark1->page_id,
                'created_at' => $bookmark1->created_at,
                'updated_at' => $bookmark1->updated_at,
            ],
            [
                'id' => $bookmark2->id,
                'user_id' => 1,
                'category_id' => $bookmark2->category_id,
                'chapter_id' => $bookmark2->chapter_id,
                'page_id' => $bookmark2->page_id,
                'created_at' => $bookmark2->created_at,
                'updated_at' => $bookmark2->updated_at,
            ]
        ];

        $actual = $service->getByUserSlug('sarina-lowe')->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetBookmarksByCategoryAndPageIds()
    {
        $bookmark = factory('App\Models\Bookmark')->create([
            'user_id' => 1,
        ]);

        $service = new BookmarkService;

        $expected = [
            'id' => $bookmark->id,
            'user_id' => 1,
            'category_id' => $bookmark->category_id,
            'chapter_id' => $bookmark->chapter_id,
            'page_id' => $bookmark->page_id,
            'created_at' => $bookmark->created_at,
            'updated_at' => $bookmark->updated_at,
        ];

        $actual = $service->getByIds(
            1,
            $bookmark->chapter_id,
            $bookmark->page_id
        )->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanStoreBookmarkWhenDoesNotExist()
    {
        $page = factory('App\Models\Page')->create([
            'approved' => 1,
        ]);

        $service = new BookmarkService;

        $service->store(1, $page->chapter_id, $page->id);

        $this->seeInDatabase('bookmarks', [
            'user_id' => 1,
            'category_id' => $page->chapter->category_id,
            'chapter_id' => $page->chapter_id,
            'page_id' => $page->id,
        ]);
    }

    public function testItDoesNotStoreAdditionalBookmarkWhenItAlreadyExists()
    {
        $bookmark = factory('App\Models\Bookmark')->create([
            'user_id' => 1,
        ]);

        $service = new BookmarkService;

        $service->store(1, $bookmark->chapter_id, $bookmark->page_id);

        $expected = 1;

        $actual = Bookmark::where('user_id', 1)
            ->where('category_id', $bookmark->category_id)
            ->where('chapter_id', $bookmark->chapter_id)
            ->where('page_id', $bookmark->page_id)
            ->count();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanDeleteBookmark()
    {
        $bookmark = factory('App\Models\Bookmark')->create([
            'user_id' => 1,
        ]);

        $service = new BookmarkService;

        $service->delete(1, $bookmark->chapter_id, $bookmark->page_id);

        $this->dontSeeInDatabase('bookmarks', [
            'user_id' => 1,
            'category_id' => $bookmark->category_id,
            'chapter_id' => $bookmark->chapter_id,
            'page_id' => $bookmark->page_id,
        ]);
    }
}
