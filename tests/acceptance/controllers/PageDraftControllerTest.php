<?php

use App\Models\PageDraft;
use App\Services\ModelServices\PageModelService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageDraftControllerTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    public $user;

    /**
     * An array of fields which should be used for compasiron purposes when
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

    public function testItCanAccessDraftsPage()
    {
        $this->logInAsUser();

        $draft = factory(App\Models\PageDraft::class)->create(['created_by' => $this->user->id]);

        $this->get('/u/' . $this->user->slug . '/drafts')
            ->see($draft->title)
            ->assertResponseStatus(200);
    }

    /**
     * Test that a request to the route that stores new page drafts works
     *
     * @return void
     */
    public function testItCanStoreNewPageDraftWithAllData()
    {
        $this->logInAsUser();

        $currentCount = PageDraft::all()->count();

        $chapter = factory(App\Models\Chapter::class)->create();

        $this->post('/u/' . $this->user->slug . '/drafts', [
                '_token' => csrf_token(),
                'category_id' => $chapter->category->id,
                'chapter_id' => $chapter->id,
                'title' => $this->faker->sentence,
                'description' => $this->faker->sentence,
                'content' => $this->faker->text,
                'last_draft_id' => null
            ])
            ->seeJson(['success' => true]);

        $expectedCount = $currentCount + 1;
        $actualCount = PageDraft::all()->count();

        $this->assertEquals($expectedCount, $actualCount);
    }

    public function testItCanEditAPageDraft()
    {
        $this->logInAsUser();

        $chapter = factory(App\Models\Chapter::class)->create();

        $this->post('/u/' . $this->user->slug . '/drafts', [
                '_token' => csrf_token(),
                'category_id' => $chapter->category->id,
                'chapter_id' => $chapter->id,
                'title' => $this->faker->sentence,
                'description' => $this->faker->sentence,
                'content' => $this->faker->text,
            ])
            ->seeJson(['success' => true]);

        $draft = PageDraft::orderBy('id', 'DESC')->first();

        $this->get('/u/' . $this->user->slug . '/drafts/' . $draft->id)
            ->see($draft->title)
            ->see($draft->description)
            ->see($draft->content)
            ->assertResponseStatus(200);
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

        $currentCount = PageDraft::all()->count();

        $chapter = factory(App\Models\Chapter::class)->create();

        $this->post('/u/' . $this->user->slug . '/drafts', [
                '_token' => csrf_token(),
            ])
            ->seeJson(['success' => true]);

        $expectedCount = $currentCount + 1;
        $actualCount = PageDraft::all()->count();

        $this->assertEquals($expectedCount, $actualCount);
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
