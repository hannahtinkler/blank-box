<?php

namespace App\Models;

use App\Interfaces\SearchableModel;
use App\Repositories\ServerRepository;
use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Server extends Model implements SearchableModel
{
    use ElasticquentTrait;

    public $guarded = [];
    private $repository;
    protected $mappingProperties = array(
        'name' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
        'nickname' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
        'location' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
        'node_number' => [
          'type' => 'int',
          "analyzer" => "standard",
        ],
        'type' => [
          'type' => 'string',
          "analyzer" => "standard",
        ]
    );

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->repository = new ServerRepository($this);
    }
    
    public function services()
    {
        return $this->hasMany('App\Models\Service');
    }
    
    public function searchResultString()
    {
        return $this->repository->searchResultString($this);
    }
    
    public function portForwardingSettings()
    {
        return $this->hasMany('App\Models\ServerPortForwardingSetting');
    }

    public function searchResultUrl()
    {
        return $this->repository->searchResultUrl($this);
    }

    public function searchResultIcon()
    {
        return $this->repository->searchResultIcon($this);
    }
}
