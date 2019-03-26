<?php

namespace Tests\Integration\Services;

use TestCase;
use App\Models\Bookmark;
use App\Services\BookmarkService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookmarkServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetBookmarksByUserSlug()
    {
        $user = factory('App\Models\User')->create();

        $bookmark1 = factory(Bookmark::class)->create([
            'user_id' => $user->id,
        ]);

        $bookmark2 = factory(Bookmark::class)->create([
            'user_id' => $user->id,
        ]);

        $service = new BookmarkService;

        $expected = [
            [
                'id' => $bookmark1->id,
                'user_id' => $user->id,
                'category_id' => $bookmark1->category_id,
                'chapter_id' => $bookmark1->chapter_id,
                'page_id' => $bookmark1->page_id,
                'created_at' => $bookmark1->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $bookmark1->updated_at->format('Y-m-d H:i:s'),
            ],
            [
                'id' => $bookmark2->id,
                'user_id' => $user->id,
                'category_id' => $bookmark2->category_id,
                'chapter_id' => $bookmark2->chapter_id,
                'page_id' => $bookmark2->page_id,
                'created_at' => $bookmark2->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $bookmark2->updated_at->format('Y-m-d H:i:s'),
            ],
        ];

        $actual = $service->getByUserSlug($user->slug)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetBookmarksByCategoryAndPageIds()
    {
        $bookmark = factory(Bookmark::class)->create([
            'user_id' => 1,
        ]);

        $service = new BookmarkService;

        $expected = [
            'id' => $bookmark->id,
            'user_id' => 1,
            'category_id' => $bookmark->category_id,
            'chapter_id' => $bookmark->chapter_id,
            'page_id' => $bookmark->page_id,
            'created_at' => $bookmark->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $bookmark->updated_at->format('Y-m-d H:i:s'),
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
        $bookmark = factory(Bookmark::class)->create([
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
        $bookmark = factory(Bookmark::class)->create([
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
