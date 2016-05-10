<?php

namespace App\Repositories;

use App\Interfaces\SearchableRepository;
use App\Models\Server;

class ServerRepository implements SearchableRepository
{
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

    public function searchResultString($result)
    {
        return 'Server: ' . $result->name . ' / ' . $result->nickname . ' - ' . $result->location . ' ' . ' (' . $result->node_type . ')';
    }

    public function searchResultUrl($result)
    {
        return '/p/mayden/servers/server-details/' . $result->id;
    }

    public function searchResultIcon($result)
    {
        return '<i class="fa fa-server"></i>';
    }
}
