<?php

namespace App\Library\Repositories;

use App\Library\Interfaces\Searchable;
use App\Library\Models\Server;

class ServerRepository implements Searchable
{
    public function getSearchResults($term)
    {
        $servers = Server::select([
            '*',
                \DB::raw("CONCAT('Server: ', nickname, ' / ', name, ' - ', location, ' ', IF(node_number, node_number, ''), ' (', type, ')') as content"),
                \DB::raw("CONCAT('/p/mayden/servers/server-details/', id)  as url")
            ])
            ->where('name', 'LIKE', '%' . $term .'%')
            ->orWhere('nickname', 'LIKE', '%' . $term .'%')
            ->orWhere('location', 'LIKE', '%' . $term .'%')
            ->orWhere('node_number', $term)
            ->orWhere('type', 'LIKE', '%' . $term .'%')
            ->get()
            ->toArray();

        return $servers;
    }
}
