<?php

use App\Models\Page;
use App\Models\PageDraft;
use App\Managers\PageDraftManager;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageDraftManagerTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    private $user;

    /**
     * An instance of the PageDraftManager class under test
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
        'created_by'
    );

    /**
     * Runs the parent setUp operations and then creates and new user.
     * Instantiates an instance of the PageDraftManager class under test
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->user = factory(App\Models\User::class)->create();
        $this->manager = new PageDraftManager($this->user);
    }

    /**
     * Tests that a call to the method which stores drafts works when it is
     * passed all the data possible from the creation form
     *
     * @return void
     */
    public function testItCanStoreAPageDraftWithAllData()
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

        $expected = $requestData;
        $expected['created_by'] = $this->user->id;

        $actual = $this->manager->savePageDraft($requestData)->toArray();

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
    }

    /**
     * Tests that a call to the method which stores drafts works when it is
     * passed no data from the creation from
     *
     * @return void
     */
    public function testItCanStoreAPageDraftWithNoData()
    {
        $chapter = factory(App\Models\Chapter::class)->create();
        $requestData = [
            '_token' => $this->faker->randomNumber(5)
        ];

        $expected = array_merge($requestData, [
            'category_id' => null,
            'chapter_id' => null,
            'title' => null,
            'description' => null,
            'content' => null,
            'created_by' => $this->user->id
        ]);

        $actual = $this->manager->savePageDraft($requestData)->toArray();

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
    }

    /**
     * Tests that a call to the method which updates drafts works when it is
     * passed all the available data from the editing form
     *
     * @return void
     */
    public function testItCanUpdateAPageDraftWithAllData()
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

        $expected = $requestData;
        $expected['created_by'] = $draft->created_by;

        $actual = $this->manager->updatePageDraft($draft, $requestData)->toArray();

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
    }

    /**
     * Tests that a call to the method which updates drafts works when it is
     * passed no data from the editing form
     *
     * @return void
     */
    public function testItCanUpdateAPageDraftWithNoData()
    {
        $draft = factory(App\Models\PageDraft::class)->create();

        $chapter = factory(App\Models\Chapter::class)->create();
        $requestData = [
            '_token' => $this->faker->randomNumber(5),
        ];

        $expected = array_merge($requestData, [
            'category_id' => null,
            'chapter_id' => null,
            'title' => null,
            'description' => null,
            'content' => null,
            'created_by' => $draft->created_by
        ]);

        $actual = $this->manager->updatePageDraft($draft, $requestData)->toArray();

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
    }

    /**
     * Tests that a call to the method which deleted drafts successfully
     * deletes a draft
     *
     * @return void
     */
    public function testItCanDeleteAPageDraft()
    {
        $draft = factory(App\Models\PageDraft::class)->create();

        $this->manager->deletePageDraft($draft->id);

        $lookup = PageDraft::find($draft->id);

        $this->assertNull($lookup);
    }
}
