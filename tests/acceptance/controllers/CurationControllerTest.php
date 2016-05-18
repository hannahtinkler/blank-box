<?php

use App\Models\Page;
use App\Services\ModelServices\PageModelService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CurationControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    public $user;

    /**
     * Test that a request to the route that shows a user the 'Pages Awaiting
     * Curation' Page shows the 'Show Curation' page and returns a 200
     * response code (OK)
     *
     * @return void
     */
    public function testItCanAccessPagesPendingCurationPage()
    {
        $this->logInAsUser();

        $this->get('/curation')
            ->see('Curation')
            ->assertResponseStatus(200);
    }

    /**
     * Test that a request to the route that approves a page awaiting curation
     * works and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanApproveAPagePendingCuration()
    {
        $this->logInAsUser();

        $page = factory(App\Models\Page::class)->create();

        $this->get('/curation/approve/' . $page->id)
            ->assertResponseStatus(302);

        $lookup = Page::find($page->id);

        $this->assertEquals(1, $lookup->approved);
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
