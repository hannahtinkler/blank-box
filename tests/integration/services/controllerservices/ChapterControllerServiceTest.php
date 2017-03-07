<?php

use App\Models\Chapter;
use App\Services\ControllerServices\ChapterControllerService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChapterControllerServiceTest extends TestCase
{
    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    private $user;

    /**
     * An instance of the ChapterControllerService class under test
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
        'category_id',
        'title',
        'description',
        'slug',
        'order',
    );

    /**
     * Runs the parent setUp operations and then creates and new user.
     * Instantiates an instance of the ChapterControllerService class under test
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

        $this->controllerService = new ChapterControllerService($prophecy->reveal());
    }

    /**
     * Tests that a call to the method which stores a chapter works when passed
     * all available data from the creation form
     *
     * @return void
     */
    public function testItCanSaveANewChapter()
    {
        $chapter = factory(App\Models\Chapter::class)->create();
        $requestData = [
            '_token' => $this->faker->randomNumber(5),
            'category_id' => $chapter->category->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
        ];

        $largestOrderValue = Chapter::largestOrderValue($requestData['category_id']);

        $expected = $requestData;
        $expected['slug'] = str_slug($requestData['title']);
        $expected['order'] = $largestOrderValue->count() ? $largestOrderValue->order + 1 : 1;
        
        $actual = $this->controllerService->storeChapter($requestData)->toArray();

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
    }

    /**
     * Test that a call to the method which updates an existing chapter works
     * when passed data from the editing form
     *
     * @return void
     */
    public function testItCanUpdateAnExistingChapter()
    {
        $chapter = factory(App\Models\Chapter::class)->create();

        $chapter = factory(App\Models\Chapter::class)->create();
        $requestData = [
            '_token' => $this->faker->randomNumber(5),
            'category_id' => $chapter->category->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'order' => $chapter->order,
        ];

        $expected = $requestData;
        $expected['slug'] = str_slug($requestData['title']);
        $expected['order'] = $chapter->order;

        $actual = $this->controllerService->updateChapter($chapter, $requestData)->toArray();

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
    }
    /**
     * Test that a call to the method which gets the next the chapter next order
     * value returns the expected number (one higher than the highest `order`
     * value in the chapters table)
     *
     * @return void
     */
    public function testItCanGetNextChapterOrderValueForAChapter()
    {
        $chapter = factory(App\Models\Chapter::class)->create(['order' => 500]);

        $expected = 501;
        $actual = $this->controllerService->getNextChapterOrderValue($chapter->category->id);

        $this->assertEquals($expected, $actual);
    }
}
