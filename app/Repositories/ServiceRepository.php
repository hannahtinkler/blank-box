<?php

namespace App\Repositories;

use App\Interfaces\SearchableRepository;
use App\Models\Service;

class ServiceRepository implements SearchableRepository
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

        return Service::searchByQuery($query);
    }

    public function searchResultString($result)
    {
        return 'Service: ' . $result->name . ' (' . $result->service_id . ') - ' . $result->server->location . ' ' . $result->server->nickname;
    }

    public function searchResultUrl($result)
    {
        return '/p/iaptus/services/service-list/' . $result->id;
    }

    public function searchResultIcon($result)
    {
        return '<i class="fa fa-group"></i>';
    }
}
