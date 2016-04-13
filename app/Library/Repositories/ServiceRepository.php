<?php

namespace App\Library\Repositories;

use App\Library\Interfaces\Searchable;
use App\Library\Models\Service;

class ServiceRepository implements Searchable
{
    public function getSearchResults($term)
    {
        $services = Service::select([
                \DB::raw("CONCAT('Service: ', services.name, ' (', services.service_id, ') - ', servers.location, ' ', servers.node_number) as content"),
                \DB::raw("CONCAT('/chapter/iaptus-services/service-list/', services.id)  as url")
            ])
            ->join('servers', 'services.server_id', '=', 'servers.id')
            ->where('services.name', 'LIKE', '%' . $term .'%')
            ->orWhere('services.area', 'LIKE', '%' . $term .'%')
            ->orWhere('services.service_id', $term)
            ->orWhere('services.type', 'LIKE', '%' . $term .'%')
            ->orWhere('servers.location', 'LIKE', '%' . $term .'%')
            ->get()
            ->toArray();

        return $services;
    }
}
