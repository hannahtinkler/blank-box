<?php

use App\Models\Chapter;
use App\Repositories\ChapterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChapterRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The current chapter being used in the test
     * @var object Chapter
     */
    public $chapter;

    /**
     * Tests that a call to the method which retrieves the text string the
     * search form uses returns as expected
     *
     * @return void
     */
    public function testSearchResultStringIsCorrect()
    {
        $repository = $this->getChapterRepository();

        $expected = 'Chapter: ' . $this->chapter->title . ' - ' . substr($this->chapter->description, 0, 60) . '...';
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
        $repository = $this->getChapterRepository();

        $expected = '/p/' . $this->chapter->category->slug . '/' . $this->chapter->slug;
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
        $repository = $this->getChapterRepository();

        $expected = '<i class="fa fa-folder-open-o"></i>';
        $actual = $repository->searchResultIcon();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Create instance of ChapterRepository class
     *
     * @return void
     */
    private function getChapterRepository()
    {
        $this->chapter = factory(Chapter::class)->create();
        return new ChapterRepository($this->chapter);
    }
}
