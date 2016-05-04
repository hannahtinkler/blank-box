<?php

namespace App\Library\Repositories;

use App\Library\Interfaces\SearchableRepository;
use App\Library\Models\Server;

class ServerRepository implements SearchableRepository
{
    public function getSearchResults($term)
    {
        return Server::searchByQuery([
            "wildcard" => ['_all' => "*" . $term . "*"]
        ]);
    }

    public function searchResultString($result)
    {
        return 'Server: ' . $result->nickname . ' / ' . $result->name . ' - ' . $result->location . ' ' . ($result->node_number ? $result->node_number : '') . ' (' . $result->type . ')';
    }

    public function searchResultUrl($result)
    {
        return '/p/mayden/servers/server-details/' . $result->id;
    }
}
