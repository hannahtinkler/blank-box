<?php

use App\Models\Page;
use App\Models\PageDraft;
use App\Managers\PageManager;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageManagerTest extends TestCase
{
    use DatabaseTransactions;
    
    private $user;
    private $manager;
    
    public $comparableFields = array(
        'chapter_id',
        'title',
        'description',
        'content',
        'created_by'
    );

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(App\Models\User::class)->create();
        $this->manager = new PageManager($this->user);
    }

    public function testSavePageDraft()
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

    public function testUpdatePageDraft()
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

    public function testSavePage()
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
        $expected['approved'] = true;
        $expected['created_by'] = $this->user->id;
        $expected['slug'] = str_slug($requestData['title']);
        $expected['order'] = $largestOrderValue->count() ? $largestOrderValue->order + 1 : 1;
        
        $actual = $this->manager->savePage($requestData)->toArray();

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
    }

    public function testUpdatePage()
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
        $expected['slug'] = str_slug($requestData['title']);
        $expected['created_by'] = $page->created_by;

        $actual = $this->manager->updatePage($page, $requestData)->toArray();

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
    }

    public function testDeletePageDraft()
    {
        $draft = factory(App\Models\PageDraft::class)->create();

        $this->manager->deletePageDraft($draft->id);

        $lookup = PageDraft::find($draft->id);

        $this->assertNull($lookup);
    }

    public function testThatDraftIsDeletedWhenPageIsSaved()
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

        $this->manager->savePage($requestData);

        $lookup = PageDraft::find($draft->id);

        $this->assertNull($lookup);
    }

    public function testGetNextPageOrderValue()
    {
        $page = factory(App\Models\Page::class)->create(['order' => 500]);

        $expected = 501;
        $actual = $this->manager->getNextPageOrderValue($page->chapter->id);

        $this->assertEquals($expected, $actual);
    }
}
