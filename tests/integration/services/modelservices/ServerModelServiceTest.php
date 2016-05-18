<?php

use App\Models\Server;
use App\Services\ModelServices\ServerModelService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServerModelServiceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The current server being used in the test
     * @var object Server
     */
    public $server;

    /**
     * Tests that a call to the method which retrieves the text string the
     * search form uses returns as expected
     *
     * @return void
     */
    public function testSearchResultStringIsCorrect()
    {
        $modelService = $this->getServerModelService();

        $expected = 'Server: ' . $this->server->name . ' / ' . $this->server->nickname . ' - ' . $this->server->location . ' ' . ' (' . $this->server->node_type . ')';
        $actual = $modelService->searchResultString();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method which retrieves the URL string the
     * search form uses returns as expected
     *
     * @return void
     */
    public function testSearchResultUrlIsCorrect()
    {
        $modelService = $this->getServerModelService();

        $expected = '/p/mayden/servers/server-details/' . $this->server->id;
        $actual = $modelService->searchResultUrl();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method which retrieves the icon html the
     * search form uses returns as expected
     *
     * @return void
     */
    public function testSearchResultIconIsCorrect()
    {
        $modelService = $this->getServerModelService();

        $expected = '<i class="fa fa-server"></i>';
        $actual = $modelService->searchResultIcon();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Create instance of ServerModelService class
     *
     * @return void
     */
    private function getServerModelService()
    {
        $this->server = factory(Server::class)->create();
        return new ServerModelService($this->server);
    }
}
