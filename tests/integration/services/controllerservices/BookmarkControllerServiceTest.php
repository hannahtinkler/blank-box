<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Bookmark;
use App\Services\ControllerServices\BookmarkControllerService;

class BookmarkControllerServiceTest extends TestCase
{
    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    private $user;

    /**
     * An instance of the BookmarkControllerService class under test
     * @var object
     */
    private $controllerService;

    /**
     * An array of fields which should be used for comparison purposes when
     * using assertEquals()
     *
     * @var array
     */
    public $comparableFields = array(
        'page_id',
        'user_id',
        'chapter_id',
        'category_id'
    );

    /**
     * Runs the parent setUp operations and then creates and new user.
     * Instantiates an instance of the BookmarkControllerService class under test
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->user = factory(App\Models\User::class)->create();

        $prophet = new Prophecy\Prophet;
        $prophecy = $prophet->prophesize('Illuminate\Http\Request');
        $prophecy->user()->willReturn($this->user);

        $this->controllerService = new BookmarkControllerService($prophecy->reveal());
    }

    /**
     * Tests that a call to the method which stores a bookmark works when passed
     * all available data from the creation form
     *
     * @return void
     */
    public function testItCanStoreANewBookmark()
    {
        $page = factory(App\Models\Page::class)->create();

        $actual = $this->controllerService->storeBookmark(
            $page->chapter->category_id,
            $page->chapter_id,
            $page->id
        )->toArray();

        $expected = [
            'category_id' => $page->chapter->category_id,
            'chapter_id' => $page->chapter_id,
            'page_id' => $page->id,
            'user_id' => $this->user->id,
        ];

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
    }
    
    public function testItCanDeleteABookmark()
    {
        $bookmark = factory(App\Models\Bookmark::class)->create(['user_id' => $this->user->id]);

        $this->controllerService->deleteBookmark($bookmark->category_id, $bookmark->chapter_id, $bookmark->page_id);

        $lookup = Bookmark::find($bookmark->id);

        $this->assertNull($lookup);
    }
}
