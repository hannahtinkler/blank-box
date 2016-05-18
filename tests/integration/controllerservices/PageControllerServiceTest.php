<?php

use App\Models\Page;
use App\Models\PageDraft;
use App\Services\ControllerServices\PageControllerService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageControllerServiceTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    private $user;

    /**
     * An instance of the PageDraftControllerService class under test
     * @var object
     */
    private $manager;

    /**
     * An array of fields which should be used for comparison purposes when
     * using assertEquals()
     *
     * @var array
     */
    public $comparableFields = array(
        'chapter_id',
        'title',
        'description',
        'content',
        'slug',
        'order',
        'approved',
        'created_by',
    );

    /**
     * Runs the parent setUp operations and then creates and new user.
     * Instantiates an instance of the PageDraftControllerService class under test
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->user = factory(App\Models\User::class)->create();
        $this->manager = new PageControllerService($this->user);
    }

    /**
     * Tests that a call to the method which stores a page works when passed
     * all available data from the creation form
     *
     * @return void
     */
    public function testItCanSaveANewPage()
    {
        $chapter = factory(App\Models\Chapter::class)->create();
        $requestData = [
            '_token' => $this->faker->randomNumber(5),
            'category_id' => $chapter->category->id,
            'chapter_id' => $chapter->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
            'last_draft_id' => null
        ];

        $largestOrderValue = Page::largestOrderValue($requestData['chapter_id']);

        $expected = $requestData;
        $expected['approved'] = false;
        $expected['created_by'] = $this->user->id;
        $expected['slug'] = str_slug($requestData['title']);
        $expected['order'] = $largestOrderValue->count() ? $largestOrderValue->order + 1 : 1;
        
        $actual = $this->manager->storePage($requestData)->toArray();

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
    }

    /**
     * Test that a call to the method which stores a suggested edit works
     * when passed data from the editing form
     *
     * @return void
     */
    public function testItCanStoreASuggestedEdit()
    {
        $page = factory(App\Models\Page::class)->create();

        $requestData = [
            '_token' => $this->faker->randomNumber(5),
            'page_id' => $page->id,
            'category_id' => $page->chapter->category->id,
            'chapter_id' => $page->chapter->id,
            'title' => $this->faker->sentence,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
        ];


        $expected = $requestData;
        $expected['created_by'] = $this->user->id;
        
        $actual = $this->manager->storeSuggestedEdit($page, $requestData)->toArray();

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
    }

    /**
     * Test that a call to the method which updates an existing page works
     * when passed data from the editing form
     *
     * @return void
     */
    public function testItCanUpdateAnExistingPage()
    {
        $page = factory(App\Models\Page::class)->create();

        $chapter = factory(App\Models\Chapter::class)->create();
        $requestData = [
            '_token' => $this->faker->randomNumber(5),
            'category_id' => $chapter->category->id,
            'chapter_id' => $chapter->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
            'order' => $page->order,
            'last_draft_id' => null
        ];

        $expected = $requestData;
        $expected['approved'] = false;
        $expected['slug'] = str_slug($requestData['title']);
        $expected['created_by'] = $page->created_by;

        $actual = $this->manager->updatePage($page, $requestData)->toArray();

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
    }

    /**
     * Test that a call to the method which deletes drafts when a page is
     * saved does in fact delete relevant drafts
     *
     * @return void
     */
    public function testAnyDraftsAreDeletedWhenAPageIsSaved()
    {
        $draft = factory(App\Models\PageDraft::class)->create();

        $chapter = factory(App\Models\Chapter::class)->create();
        $requestData = [
            '_token' => $this->faker->randomNumber(5),
            'category_id' => $chapter->category->id,
            'chapter_id' => $chapter->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
            'last_draft_id' => $draft->id
        ];

        $this->manager->storePage($requestData);

        $lookup = PageDraft::find($draft->id);

        $this->assertNull($lookup);
    }

    /**
     * Test that a call to the method which gets the next the page next order
     * value returns the expected number (one higher
     * than the highest `order` value in the pages table)
     *
     * @return void
     */
    public function testItCanGetNextPageOrderValueForAChapter()
    {
        $page = factory(App\Models\Page::class)->create(['order' => 500]);

        $expected = 501;
        $actual = $this->manager->getNextPageOrderValue($page->chapter->id);

        $this->assertEquals($expected, $actual);
    }
}
