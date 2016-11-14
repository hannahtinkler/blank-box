<?php

use App\Services\ControllerServices\SearchControllerService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchControllerServiceTest extends TestCase
{
    use DatabaseTransactions;
    
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
        $controllerService = new SearchControllerService($this->request, 'Cloud1');

        $actual = $controllerService->processSearch(config('elasticquent.searchables'));
        $expected = [
            'content' => "Server: Cloud1 / Box server 1 - Box  (VBox Host)",
            'url' => "/p/mayden/servers/server-details/1",
        ];

        unset($actual[0]['score']);

        $this->assertEquals($expected, $actual[0]);
    }
}
