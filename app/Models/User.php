<?php

namespace App\Models;

use App\Interfaces\SearchableModel;
use App\Services\ModelServices\UserModelService;
use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements SearchableModel
{
    use ElasticquentTrait;

    public $repository;
    public $guarded = [];
    protected $mappingProperties = array(
        'name' => [
          'type' => 'string',
          "analyzer" => "standard",
        ]
    );

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->repository = new UserModelService($this);
    }
    
    public function searchResultString()
    {
        return $this->repository->searchResultString();
    }
    
    public function searchResultUrl()
    {
        return $this->repository->searchResultUrl();
    }
    
    public function searchResultIcon()
    {
        return $this->repository->searchResultIcon();
    }
}
