<?php

use App\Models\User;
use App\Models\Page;
use App\Repositories\PageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Tests that a call to the method which retrieves the text string the
     * search form uses returns as expected
     *
     * @return void
     */
    public function testSearchResultStringIsCorrect()
    {
        $repository = $this->getPageRepository();

        $expected = 'Page: ' . $this->page->title;
        $actual = $repository->searchResultString();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method which retrieves the URL string the
     * search form uses returns as expected
     *
     * @return void
     */
    public function testSearchResultUrlIsCorrect()
    {
        $repository = $this->getPageRepository();

        $expected = '/p/' . $this->page->chapter->category->slug . '/' . $this->page->chapter->slug . '/' . $this->page->slug;
        $actual = $repository->searchResultUrl();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method which retrieves the icon html the
     * search form uses returns as expected
     *
     * @return void
     */
    public function testSearchResultIconIsCorrect()
    {
        $repository = $this->getPageRepository();

        $expected = '<i class="fa fa-file-o"></i>';
        $actual = $repository->searchResultIcon();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method which determines whether a page should
     * be editable by the logged in user returns false for a reader
     *
     * @return void
     */
    public function testPageIsNotEditableByReader()
    {
        $repository = $this->getPageRepository();
        $this->assertFalse($repository->editableByUser());
    }

    /**
     * Tests that a call to the method which determines whether a page should
     * be editable by the logged in user returns true for an author
     *
     * @return void
     */
    public function testPageIsEditableByAuthor()
    {
        $repository = $this->getPageRepository([], true);
        $this->assertTrue($repository->editableByUser());
    }

    /**
     * Tests that a call to the method which determines whether a page should
     * be editable by the logged in user returns true for a curator
     *
     * @return void
     */
    public function testPageIsEditableByCurator()
    {
        $repository = $this->getPageRepository(['curator' => true]);
        $this->assertTrue($repository->editableByUser());
    }
    
    /**
     * Create instance of PageRepository class using any configurations
     * passed in
     *
     * @param  array   $userOverrides   Fields to be overriden for the User
     * @param  boolean $makeUserAuthor  Whether to make the user the page author
     * @return PageRepository           The repository instance to be used in the test
     */
    private function getPageRepository($userOverrides = [], $makeUserAuthor = false)
    {
        $this->user = factory(User::class)->create($userOverrides);
        if ($makeUserAuthor) {
            $this->page = factory(Page::class)->create(['created_by' => $this->user->id]);
        } else {
            $this->page = factory(Page::class)->create();
        }
        return new PageRepository($this->page, $this->user);
    }
}
