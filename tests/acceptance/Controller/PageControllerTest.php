<?php

use App\Models\Page;
use App\Repositories\PageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageControllerTest extends TestCase
{
    use DatabaseTransactions;
    
    public $comparableFields = array(
        'chapter_id',
        'title',
        'description',
        'content',
        'created_by'
    );

    public $user;

    public function testItCanAccessCreatePagePage()
    {
        $this->logInAsUser();

        $this->get('/page/create')
            ->see('Create New Page')
            ->assertResponseStatus(200);
    }

    public function testItCanAccessEditPagePage()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create(['created_by' => $this->user->id]);

        $this->get('/page/edit/' . $page->id)
            ->see('Edit Page')
            ->assertResponseStatus(200);
    }

    public function testItCanAccessPreviewPagePage()
    {
        $this->logInAsUser();

        $draft = factory(App\Models\PageDraft::class)->create();

        $this->visit('/page/preview/' . $draft->id)
            ->see($draft->title)
            ->assertResponseStatus(200);
    }

    public function testItCanStoreNewPage()
    {
        $this->logInAsUser();

        $currentCount = Page::all()->count();

        $chapter = factory(App\Models\Chapter::class)->create();

        $this->post('/page', [
                '_token' => csrf_token(),
                'category_id' => $chapter->category->id,
                'chapter_id' => $chapter->id,
                'title' => $this->faker->sentence,
                'description' => $this->faker->sentence,
                'content' => $this->faker->text,
                'last_draft_id' => null
            ])
            ->assertResponseStatus(302);

        $expectedCount = $currentCount + 1;
        $actualCount = Page::all()->count();

        $this->assertEquals($expectedCount, $actualCount);
    }

    public function testItCanUpdatePage()
    {
        $this->logInAsUser(['curator' => true]);

        $page = factory(App\Models\Page::class)->create();

        $data = [
            '_token' => csrf_token(),
            'category_id' => $page->chapter->category->id,
            'chapter_id' => $page->chapter->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
            'last_draft_id' => null
        ];

        $this->put('/page/' . $page->id, $data)
            ->assertResponseStatus(302);

        $expected = $data;
        $expected['created_by'] = $page->created_by;

        $actual = Page::find($page->id)->toArray();

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
    }

    public function testPageDestroy()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create();

        $this->delete('/page/' . $page->id)
            ->assertResponseStatus(302);

        $lookup = Page::find($page->id);

        $this->assertNull($lookup);
    }

    public function logInAsUser($overrides = [])
    {
        $this->user = factory(App\Models\User::class)->create($overrides);
        $this->be($this->user);
    }
}
