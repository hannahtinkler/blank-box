<?php

namespace Tests\Acceptance\Controllers;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Page;
use App\Models\SuggestedEdit;
use App\Services\ModelServices\PageModelService;

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
        $this->logInAsUser(['curator' => 1]);

        $this->get('/curation/new')->see('Curation')->assertResponseStatus(200);
    }

    /**
     * Test that a request to the route that shows a user the 'Pages Awaiting
     * Curation' Page shows the 'Show Curation' page and returns a 200
     * response code (OK)
     *
     * @return void
     */
    public function testItCanAccessSuggestedEditsPendingCurationPage()
    {
        $this->logInAsUser(['curator' => 1]);

        $this->get('/curation/edits')->see('Curation')->assertResponseStatus(200);
    }

    /**
     * Test that a request to the route that shows a user the 'Pages Awaiting
     * Curation' Page shows the 'Show Curation' page and returns a 200
     * response code (OK)
     *
     * @return void
     */
    public function testItCanNotAccessPagesPendingCurationPage()
    {
        $this->logInAsUser(['curator' => 0]);

        $this->get('/curation/new')->assertResponseStatus(401);
    }

    /**
     * Test that a request to the route that shows a user the 'Pages Awaiting
     * Curation' Page shows the 'Show Curation' page and returns a 200
     * response code (OK)
     *
     * @return void
     */
    public function testItCanNotAccessSuggestedEditsPendingCurationPage()
    {
        $this->logInAsUser(['curator' => 0]);

        $this->get('/curation/edits')->assertResponseStatus(401);
    }

    /**
     * Test that a request to the route that approves a page awaiting curation
     * works and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanApproveAPagePendingCuration()
    {
        $this->logInAsUser(['curator' => 1]);

        $page = factory('App\Models\Page')->create();

        $this->get('/curation/new/approve/' . $page->id)->assertResponseStatus(302);

        $this->seeInDatabase('pages', [
            'id' => $page->id,
            'approved' => 1,
        ]);
    }

    public function testItCanRejectAPagePendingCuration()
    {
        $this->logInAsUser(['curator' => 1]);

        $page = factory('App\Models\Page')->create();

        $this->get('/curation/new/reject/' . $page->id)
            ->assertResponseStatus(302);

        $this->seeInDatabase('pages', [
            'id' => $page->id,
            'approved' => 0,
        ]);
    }

    /**
     * Test that a request to the route that approves an edit awaiting curation
     * works and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanApproveASuggestedEditPendingCuration()
    {
        $this->logInAsUser(['curator' => 1]);

        $edit = factory('App\Models\SuggestedEdit')->create();

        $this->get('/curation/edits/approve/' . $edit->id)->assertResponseStatus(302);

        $this->seeInDatabase('suggested_edits', [
            'id' => $edit->id,
            'approved' => 1,
        ]);
    }

    /**
     * Test that a request to the route that rejects an edit awaiting curation
     * works and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanRejectASuggestedEditPendingCuration()
    {
        $this->logInAsUser(['curator' => 1]);

        $edit = factory('App\Models\SuggestedEdit')->create();

        $this->get('/curation/edits/reject/' . $edit->id)->assertResponseStatus(302);

        $this->seeInDatabase('suggested_edits', [
            'id' => $edit->id,
            'approved' => 0,
        ]);
    }

    /**
     * Test that a request to the route that returns a diff of the original page
     * and the edit returns the required html and a 200 response (OK)
     *
     * @return void
     */
    public function testItCanViewDiffForSuggestedEdit()
    {
        $this->logInAsUser(['curator' => 1]);

        $edit = factory('App\Models\SuggestedEdit')->create();

        $this->get('/curation/viewdiff/' . $edit->id)
            ->see('<ins>')
            ->see('<del>')
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
        $this->user = factory('App\Models\User')->create($overrides);
        $this->be($this->user);
    }
}
