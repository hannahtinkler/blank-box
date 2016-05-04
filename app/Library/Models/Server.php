<?php

namespace App\Library\Models;

use App\Library\Interfaces\SearchableModel;
use App\Library\Repositories\ServerRepository;
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
          "analyzer" => "standard"
        ],
        'location' => [
          'type' => 'string',
          "analyzer" => "standard"
        ],
        'node_number' => [
          'type' => 'int',
          "analyzer" => "standard"
        ],
        'type' => [
          'type' => 'string',
          "analyzer" => "standard"
        ]
    );

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->repository = new ServerRepository($this);
    }
    
    public function services()
    {
        return $this->hasMany('App\Library\Models\Service');
    }
    
    public function searchResultString()
    {
        return $this->repository->searchResultString($this);
    }
    
    public function searchResultUrl()
    {
        return $this->repository->searchResultUrl($this);
    }
}
