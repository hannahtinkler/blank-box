<?php

namespace App\Library\Repositories;

use App\Library\Interfaces\SearchableRepository;
use App\Library\Models\Server;

class ServerRepository implements SearchableRepository
{
    public function getSearchResults($term)
    {
        $query = [
            "bool" => [
                "should" => [
                    [ "wildcard" => [ "_all" => "$term*"]],
                    [ "match" => [ "_all" => "$term" ]]
                ]
            ]
        ];

        return Server::searchByQuery($query);
    }

    public function searchResultString($result)
    {
        return 'Server: ' . $result->name . ' / ' . $result->nickname . ' - ' . $result->location . ' ' . ($result->node_number ? $result->node_number : '') . ' (' . $result->type . ')';
    }

    public function searchResultUrl($result)
    {
        return '/p/mayden/servers/server-details/' . $result->id;
    }
}
