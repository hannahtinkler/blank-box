<?php

use App\Models\Service;
use App\Models\Server;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServiceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Tests that a call to the server relationship returns the server that
     * this service belongs to
     *
     * @return void
     */
    public function testServerRelationshipReturnsServer()
    {
        $service = factory(Service::class)->create();

        $this->assertTrue($service->server instanceof Server);
    }

    /**
     * Tests that a call to the method that returns the search result string
     * for a given record works as expected
     *
     * @return void
     */
    public function testSearchResultStringIsCorrect()
    {
        $service = factory(Service::class)->create();

        $expected = 'Service: ' . $service->name . ' (' . $service->service_id . ') - ' . $service->server->location . ' ' . $service->server->nickname;
        $actual = $service->searchResultString();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method that returns the search result url
     * for a given record works as expected
     *
     * @return void
     */
    public function testSearchResultUrlIsCorrect()
    {
        $service = factory(Service::class)->create();

        $expected = '/p/iaptus/services/service-list/' . $service->id;
        $actual = $service->searchResultUrl();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method that returns the search result icon
     * for a given record works as expected
     *
     * @return void
     */
    public function testSearchResultIconIsCorrect()
    {
        $service = factory(Service::class)->create();

        $expected = '<i class="fa fa-group"></i>';
        $actual = $service->searchResultIcon();

        $this->assertEquals($expected, $actual);
    }
}
