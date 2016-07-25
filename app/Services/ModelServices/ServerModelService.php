<?php

namespace App\Services\ModelServices;

use Illuminate\Http\Request;

use App\Interfaces\SearchableModelService;
use App\Models\Server;

class ServerModelService implements SearchableModelService
{
    public $server;

    public function __construct($server)
    {
        $this->server = $server;
    }

    public function getSearchResults($term)
    {
        $query = [
            "bool" => [
                "should" => [
                    [ "wildcard" => [ "_all" => "*$term*"]],
                    [ "match" => [ "_all" => "$term" ]]
                ]
            ]
        ];

        return Server::searchByQuery($query);
    }

    public function searchResultString()
    {
        return 'Server: ' . $this->server->name . ' / ' . $this->server->nickname . ' - ' . $this->server->location . ' ' . ' (' . $this->server->node_type . ')';
    }

    public function searchResultUrl()
    {
        return '/p/mayden/servers/server-details/' . $this->server->id;
    }

    public function searchResultIcon()
    {
        return '<i class="fa fa-server"></i>';
    }
}
