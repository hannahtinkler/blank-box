<?php

use App\Models\Page;
use App\Models\User;
use App\Models\Chapter;
use App\Models\Bookmark;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageTest extends TestCase
{
    use DatabaseTransactions;

    public function testChapterRelationshipReturnsChapter()
    {
        $page = factory(Page::class)->create();
        $this->assertTrue($page->chapter instanceof Chapter);
    }

    public function testBookmarksRelationshipReturnsBookmark()
    {
        $page = factory(Page::class)->create();
        factory(Bookmark::class)->create(['page_id' => $page->id]);

        $this->assertTrue($page->bookmark instanceof Bookmark);
    }

    public function testCreatorRelationshipReturnsCreator()
    {
        $page = factory(Page::class)->create();
        $this->assertTrue($page->creator instanceof User);
    }
    
    public function testScopeLatestUpdated()
    {
        $page1 = factory(Page::class)->create(['updated_at' => '2020-05-01 12:43:23']);
        $page2 = factory(Page::class)->create(['updated_at' => '2020-05-10 12:43:23']);
        $page3 = factory(Page::class)->create(['updated_at' => '2020-05-06 12:43:23']);
        
        $expected = Page::find($page2->id)->toArray();
        $actual = Page::latestUpdated()->first()->toArray();

        $this->assertEquals($expected, $actual);
    }
    
    public function testScopeFindBySlug()
    {
        $page = factory(Page::class)->create();
        
        $expected = Page::find($page->id)->toArray();
        $actual = Page::findBySlug($page->slug)->toArray();

        $this->assertEquals($expected, $actual);
    }
    
    public function testScopeLargestOrderValue()
    {
        $chapter = factory(Page::class)->create();
        $page1 = factory(Page::class)->create(['chapter_id' => $chapter->id, 'order' => 5]);
        $page2 = factory(Page::class)->create(['chapter_id' => $chapter->id, 'order' => 25]);
        $page3 = factory(Page::class)->create(['chapter_id' => $chapter->id, 'order' => 15]);
        
        $expected = Page::find($page2->id)->toArray();
        $actual = Page::largestOrderValue($chapter->id)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItFetchesLatestUpdatedPages()
    {
        factory(Page::class, 2)->create(['updated_at' => '2015-09-03 10:26:23']);
        factory(Page::class, 1)->create(['updated_at' => '2016-01-18 11:26:23']);
        $newest = factory(Page::class, 1)->create(['updated_at' => '2017-05-13 09:26:23']);

        $pages = Page::latestUpdated()->get();

        $this->assertEquals($newest->id, $pages->first()->id);
    }

    public function testShowRedirectUrlIsCorrect()
    {
        $page = factory(Page::class)->create();

        $expected = '/p/' . $page->chapter->category->slug . '/' . $page->chapter->slug . '/' . $page->slug;
        $actual = $page->searchResultUrl();

        $this->assertEquals($expected, $actual);
    }

    public function testSearchResultStringIsCorrect()
    {
        $page = factory(Page::class)->create();

        $expected = 'Page: ' . $page->title;
        $actual = $page->searchResultString();

        $this->assertEquals($expected, $actual);
    }

    public function testSearchResultUrlIsCorrect()
    {
        $page = factory(Page::class)->create();

        $expected = '/p/' . $page->chapter->category->slug . '/' . $page->chapter->slug . '/' . $page->slug;
        $actual = $page->searchResultUrl();

        $this->assertEquals($expected, $actual);
    }

    public function testSearchResultIconIsCorrect()
    {
        $page = factory(Page::class)->create();

        $expected = '<i class="fa fa-file-o"></i>';
        $actual = $page->searchResultIcon();

        $this->assertEquals($expected, $actual);
    }

    public function testPageIsNotEditableByNonAuthor()
    {
        $this->createAndLoginAUser();
        $page = factory(Page::class)->create();

        $this->assertFalse($page->editableByUser());
    }

    public function testPageIsEditableByAuthor()
    {
        $user = $this->createAndLoginAUser();
        $page = factory(Page::class)->create(['created_by' => $user->id]);

        $this->assertTrue($page->editableByUser());
    }

    public function testPageIsEditableByCurator()
    {
        $this->createAndLoginAUser(['curator' => true]);
        $page = factory(Page::class)->create();

        $this->assertTrue($page->editableByUser());
    }
    
    public function createAndLoginAUser($overrides = [])
    {
        $user = factory(User::class)->create($overrides);
        Auth::login($user);

        return $user;
    }
}
