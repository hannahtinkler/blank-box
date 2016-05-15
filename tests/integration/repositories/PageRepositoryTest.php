<?php

use App\Models\User;
use App\Models\Page;
use App\Repositories\PageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testShowRedirectUrlIsCorrect()
    {
        $repository = $this->getDatabaseRepository();

        $expected = '/p/' . $this->page->chapter->category->slug . '/' . $this->page->chapter->slug . '/' . $this->page->slug;
        $actual = $repository->showRedirectUrl();

        $this->assertEquals($expected, $actual);
    }

    public function testSearchResultStringIsCorrect()
    {
        $repository = $this->getDatabaseRepository();

        $expected = 'Page: ' . $this->page->title;
        $actual = $repository->searchResultString();

        $this->assertEquals($expected, $actual);
    }

    public function testSearchResultUrlIsCorrect()
    {
        $repository = $this->getDatabaseRepository();

        $expected = '/p/' . $this->page->chapter->category->slug . '/' . $this->page->chapter->slug . '/' . $this->page->slug;
        $actual = $repository->searchResultUrl();

        $this->assertEquals($expected, $actual);
    }

    public function testSearchResultIconIsCorrect()
    {
        $repository = $this->getDatabaseRepository();

        $expected = '<i class="fa fa-file-o"></i>';
        $actual = $repository->searchResultIcon();

        $this->assertEquals($expected, $actual);
    }

    public function testPageIsNotEditableByNonAuthor()
    {
        $repository = $this->getDatabaseRepository();
        $this->assertFalse($repository->editableByMe());
    }

    public function testPageIsEditableByAuthor()
    {
        $repository = $this->getDatabaseRepository([], true);
        $this->assertTrue($repository->editableByMe());
    }

    public function testPageIsEditableByCurator()
    {
        $repository = $this->getDatabaseRepository(['curator' => true]);
        $this->assertTrue($repository->editableByMe());
    }

    private function getDatabaseRepository($userOverride = [], $makeUserAuthor = false)
    {
        $this->user = factory(User::class)->create($userOverride);
        if ($makeUserAuthor) {
            $this->page = factory(Page::class)->create(['created_by' => $this->user->id]);
        } else {
            $this->page = factory(Page::class)->create();
        }
        return new PageRepository($this->page, $this->user);
    }
}
