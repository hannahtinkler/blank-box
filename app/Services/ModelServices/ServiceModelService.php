<?php

namespace App\Services\ModelServices;

use Illuminate\Http\Request;

use App\Models\Service;
use App\Interfaces\SearchableModelService;

class ServiceModelService implements SearchableModelService
{
    public $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

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

        return Service::searchByQuery($query);
    }

    public function searchResultString()
    {
        return 'Service: ' . $this->service->name . ' (' . $this->service->service_id . ') - ' . $this->service->server->location . ' ' . $this->service->server->nickname;
    }

    public function searchResultUrl()
    {
        return '/p/iaptus/services/service-list/' . $this->service->id;
    }

    public function searchResultIcon()
    {
        return '<i class="fa fa-group"></i>';
    }
}
