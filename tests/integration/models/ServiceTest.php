<?php

use App\Models\Service;
use App\Models\Server;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testServerRelationshipReturnsServer()
    {
        $service = factory(Service::class)->create();

        $this->assertTrue($service->server instanceof Server);
    }

    public function testSearchResultStringIsCorrect()
    {
        $service = factory(Service::class)->create();

        $expected = 'Service: ' . $service->name . ' (' . $service->service_id . ') - ' . $service->server->location . ' ' . $service->server->nickname;
        $actual = $service->searchResultString();

        $this->assertEquals($expected, $actual);
    }

    public function testSearchResultUrlIsCorrect()
    {
        $service = factory(Service::class)->create();

        $expected = '/p/iaptus/services/service-list/' . $service->id;
        $actual = $service->searchResultUrl();

        $this->assertEquals($expected, $actual);
    }

    public function testSearchResultIconIsCorrect()
    {
        $service = factory(Service::class)->create();

        $expected = '<i class="fa fa-group"></i>';
        $actual = $service->searchResultIcon();

        $this->assertEquals($expected, $actual);
    }
}
