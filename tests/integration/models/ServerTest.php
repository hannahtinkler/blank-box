<?php

use App\Models\Server;
use App\Models\ServerPortForwardingSetting;
use App\Models\Service;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServerTest extends TestCase
{
    use DatabaseTransactions;

    public function testServicesRelationshipReturnsServices()
    {
        $server = factory(Server::class)->create();
        factory(Service::class, 2)->create(['server_id' => $server->id]);

        $this->assertTrue($server->services->first() instanceof Service);
    }

    public function testPortForwardingSettingsRelationshipReturnsPortForwardingSettings()
    {
        $server = factory(Server::class)->create();
        factory(ServerPortForwardingSetting::class, 2)->create(['server_id' => $server->id]);

        $this->assertTrue($server->portForwardingSettings->first() instanceof ServerPortForwardingSetting);
    }

    public function testSearchResultStringIsCorrect()
    {
        $server = factory(Server::class)->create();

        $expected = 'Server: ' . $server->name . ' / ' . $server->nickname . ' - ' . $server->location . ' ' . ' (' . $server->node_type . ')';
        $actual = $server->searchResultString();

        $this->assertEquals($expected, $actual);
    }

    public function testSearchResultUrlIsCorrect()
    {
        $server = factory(Server::class)->create();

        $expected = '/p/mayden/servers/server-details/' . $server->id;
        $actual = $server->searchResultUrl();

        $this->assertEquals($expected, $actual);
    }

    public function testSearchResultIconIsCorrect()
    {
        $server = factory(Server::class)->create();

        $expected = '<i class="fa fa-server"></i>';
        $actual = $server->searchResultIcon();

        $this->assertEquals($expected, $actual);
    }
}
