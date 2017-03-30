<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\PageDraft;
use App\Services\ModelServices\PageModelService;

class PageDraftControllerTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * @var object User
     */
    public $user;

    public function testItCanAccessDraftsPage()
    {
        $this->logInAsUser();

        $draft = factory('App\Models\PageDraft')->create(['created_by' => $this->user->id]);

        $this->get('/u/' . $this->user->slug . '/drafts')->see($draft->title)->assertResponseStatus(200);
    }

    /**
     * Test that a request to the route that stores new page drafts works
     *
     * @return void
     */
    public function testItCanStoreNewPageDraftWithAllData()
    {
        $this->logInAsUser();

        $data = [
            '_token' => csrf_token(),
            'category_id' => 1,
            'chapter_id' => 1,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
            'last_draft_id' => null
        ];

        $this->post('/u/' . $this->user->slug . '/drafts', $data)->seeJson(['success' => true]);

        $this->seeInDatabase('page_drafts', [
            'chapter_id' => $data['chapter_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
            'created_by' => $this->user->id,
        ]);
    }

    public function testItCanEditAPageDraft()
    {
        $this->logInAsUser();

        $draft = factory(App\Models\PageDraft::class)->create(['created_by' => $this->user->id]);

        $data = [
            '_token' => csrf_token(),
            'category_id' => 1,
            'chapter_id' => 1,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->text,
        ];

        $this->post('/u/' . $this->user->slug . '/drafts/' . $draft->id, $data)->seeJson(['success' => true]);

        $this->seeInDatabase('page_drafts', [
            'id' => $draft->id,
            'chapter_id' => $data['chapter_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
            'created_by' => $this->user->id,
        ]);
    }

    /**
     * Test that a request to the route that stores new page drafts works when
     * passed no data from the creation form
     *
     * @return void
     */
    public function testItCanStoreNewPageDraftWithNoData()
    {
        $this->logInAsUser();

        $data = [
            '_token' => csrf_token(),
        ];

        $this->post('/u/' . $this->user->slug . '/drafts', $data)->seeJson(['success' => true]);

        $this->seeInDatabase('page_drafts', [
            'chapter_id' => null,
            'title' => null,
            'description' => null,
            'content' => null,
            'created_by' => $this->user->id,
        ]);
    }

    /**
     * Test that a request to the route that shows the user a page draft preview
     * does in fact show a page draft preview
     *
     * @return void
     */
    public function testItCanAccessPageDraftPreviewPage()
    {
        $this->logInAsUser();

        $draft = factory(App\Models\PageDraft::class)->create(['created_by' => $this->user->id]);

        $this->visit('/u/' . $this->user->slug . '/drafts/preview/' . $draft->id)
            ->see($draft->title)
            ->assertResponseStatus(200);
    }

    /**
     * Logs in a new user so that we can path successfully though
     * authentication
     *
     * @return void
     */
    public function logInAsUser($overrides = [])
    {
        $this->user = factory(App\Models\User::class)->create($overrides);
        $this->be($this->user);
    }
}
