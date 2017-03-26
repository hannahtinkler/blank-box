<?php

use App\Services\ControllerServices\SearchControllerService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchControllerServiceTest extends TestCase
{
    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    private $user;
    private $request;
    

    /**
     * Runs the parent setUp operations and then creates and new user.
     * Instantiates an instance of the SearchControllerService class under test
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

        $this->request = $prophecy->reveal();
    }

    public function testProcessSearchReturnsResults()
    {
        putenv('ELASTICSEARCH_INDEX=blank_box_test');
        
        $page = factory(App\Models\Page::class)->create([
            'approved' => true
        ]);

        $page->addToIndex();

        // sleep(1);

        $controllerService = new SearchControllerService($this->request, $page->title);

        $actual = $controllerService->processSearch(config('elasticquent.searchables'));
        
        $expected = [
            'content' => 'Page: ' . $page->title,
            'url' => '/p/' . $page->chapter->category->slug . '/' . $page->chapter->slug . '/' . $page->slug,
        ];

        unset($actual[0]['score']);

        $this->assertEquals($expected, $actual[0]);
    }
}
