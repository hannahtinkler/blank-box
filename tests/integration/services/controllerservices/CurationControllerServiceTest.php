<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Page;
use App\Models\SuggestedEdit;
use App\Models\SlugForwardingSetting;
use App\Services\ControllerServices\CurationControllerService;
use App\Services\ControllerServices\PageControllerService;
use App\Services\ControllerServices\PageDraftControllerService;

class CurationControllerServiceTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    private $user;

    /**
     * An instance of the CurationControllerService class under test
     * @var object
     */
    private $controllerService;

    /**
     * An array of fields which should be used for comparison purposes when
     * using assertEquals()
     *
     * @var array
     */
    public $comparableFields = array();

    /**
     * Runs the parent setUp operations and then creates and new user.
     * Instantiates an instance of the CurationControllerService class under test
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

        $pageDraftControllerService = new PageDraftControllerService($prophecy->reveal());
        $pageControllerService = new PageControllerService($prophecy->reveal(), $pageDraftControllerService);

        $this->controllerService = new CurationControllerService($prophecy->reveal(), $pageControllerService);
    }

    public function testItCanApproveSuggestedEdit()
    {
        $edit = factory(App\Models\SuggestedEdit::class)->create();

        $this->controllerService->approveSuggestedEdit($edit->id);

        $lookup = SuggestedEdit::find($edit->id);

        $this->assertEquals(1, $lookup->approved);
    }

    public function testItCanRejectSuggestedEdit()
    {
        $edit = factory(App\Models\SuggestedEdit::class)->create();

        $this->controllerService->rejectSuggestedEdit($edit->id);

        $lookup = SuggestedEdit::find($edit->id);

        $this->assertEquals(0, $lookup->approved);
    }

    public function testItCanApproveNewPage()
    {
        $page = factory(App\Models\Page::class)->create();

        $this->controllerService->approveNewPage($page->id);

        $lookup = Page::find($page->id);

        $this->assertEquals(1, $lookup->approved);

    }

    public function testItCanRejectNewPage()
    {
        $page = factory(App\Models\Page::class)->create();

        $this->controllerService->rejectNewPage($page->id);

        $lookup = Page::find($page->id);

        $this->assertEquals(0, $lookup->approved);
    }

    public function testItCanGetPageDiff()
    {
        $edit = factory(App\Models\SuggestedEdit::class)->create();
        $original = $edit->page;

        $diff = $this->controllerService->getPageDiff($original, $edit);

        $this->assertContains('<ins>', $diff['content']);
        $this->assertContains('<del>', $diff['content']);
    }
}
