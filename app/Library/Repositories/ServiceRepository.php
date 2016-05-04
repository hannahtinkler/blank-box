<?php

namespace App\Library\Repositories;

use App\Library\Interfaces\SearchableRepository;
use App\Library\Models\Service;

class ServiceRepository implements SearchableRepository
{
    public function getSearchResults($term)
    {
        return Service::search($term);
    }

    public function searchResultString($result)
    {
        return 'Service: ' . $result->name . ' (' . $result->service_id . ') - ' . $result->server->location . ' ' . $result->server->node_number;
    }

    public function searchResultUrl($result)
    {
        return '/p/iaptus/services/service-details/' . $result->id;
    }
}
