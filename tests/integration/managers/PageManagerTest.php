<?php

use App\Models\Page;
use App\Models\PageDraft;
use App\Managers\PageManager;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageManagerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

        $this->faker = Faker\Factory::create();
        $this->user = factory(App\Models\User::class)->create();
        $this->manager = new PageManager($this->user);
    }

    public function testSavePageDraft()
    {
        $data = [
            'id' => $this->faker->randomNumber(5),
            'chapter_id' => factory(App\Models\Chapter::class)->create()->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
            'created_by' => $this->user->id,
            'created_at' => $this->faker->dateTime->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTime->format('Y-m-d H:i:s'),
            'last_draft_id' => null
        ];

        $actual = $this->manager->savePageDraft($data)->toArray();

        $this->assertEquals(array_except(
            $data,
            ['last_draft_id']
        ), $actual);
    }

    public function testUpdatePageDraft()
    {
        $draft = factory(App\Models\PageDraft::class)->create();

        $newData = [
            'id' => $this->faker->randomNumber(5),
            'chapter_id' => factory(App\Models\Chapter::class)->create()->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
            'created_by' => $this->user->id,
            'created_at' => $this->faker->dateTime->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTime->format('Y-m-d H:i:s'),
            'last_draft_id' => $draft->id
        ];

        $actual = $this->manager->updatePageDraft($draft, $newData)->toArray();

        $this->assertEquals(array_except(
            $newData,
            ['last_draft_id']
        ), $actual);
    }

    public function testCreatePage()
    {
        $data = [
            'id' => $this->faker->randomNumber(5),
            'chapter_id' => factory(App\Models\Chapter::class)->create()->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
            'created_by' => $this->user->id,
            'created_at' => $this->faker->dateTime->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTime->format('Y-m-d H:i:s'),
            'last_draft_id' => null
        ];

        $largestOrderValue = Page::largestOrderValue($data['chapter_id']);
        $data['order'] = $largestOrderValue->count() ? $largestOrderValue->order + 1 : 1;
        $data['approved'] = true;

        $actual = $this->manager->savePage($data)->toArray();

        $this->assertEquals(array_except(
            $data,
            ['last_draft_id']
        ), $actual);
    }

    public function testUpdatePage()
    {
        $page = factory(App\Models\Page::class)->create();

        $newTitle = $this->faker->sentence;
        $newData = [
            'id' => $this->faker->randomNumber(5),
            'chapter_id' => factory(App\Models\Chapter::class)->create()->id,
            'title' => $newTitle,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
            'slug' => str_slug($newTitle),
            'order' => $page->order,
            'created_by' => $this->user->id,
            'created_at' => $this->faker->dateTime->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTime->format('Y-m-d H:i:s'),
            'last_draft_id' => null
        ];

        $actual = $this->manager->updatePage($page, $newData)->toArray();

        $this->assertEquals(array_except(
            $newData,
            ['last_draft_id']
        ), $actual);
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

        $data = [
            'id' => $this->faker->randomNumber(5),
            'chapter_id' => factory(App\Models\Chapter::class)->create()->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
            'created_by' => $this->user->id,
            'created_at' => $this->faker->dateTime->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTime->format('Y-m-d H:i:s'),
            'last_draft_id' => $draft->id
        ];

        $this->manager->savePage($data);

        $lookup = PageDraft::find($draft->id);

        $this->assertNull($lookup);
    }
}
