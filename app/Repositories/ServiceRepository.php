<?php

namespace App\Repositories;

use Auth;
use App\Interfaces\SearchableRepository;
use App\Models\Service;

class ServiceRepository implements SearchableRepository
{
    public $user;
    public $service;

    public function __construct($service)
    {
        $this->user = Auth::user();
        $this->service = $service;
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
