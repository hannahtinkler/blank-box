<?php

namespace App\Library\Models;

use App\Library\Interfaces\SearchableModel;
use App\Library\Repositories\ServiceRepository;
use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Service extends Model implements SearchableModel
{
    use ElasticquentTrait;

    public $guarded = [];
    private $repository;

    protected $mappingProperties = array(
        'name' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
        'area' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
        'service_id' => [
          'type' => 'int',
          "analyzer" => "standard",
        ],
        'type' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
        'live_site_url' => [
          'type' => 'string',
          "analyzer" => "standard",
        ]
    );

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->repository = new ServiceRepository($this);
    }

    // public function getTypeName()
    // {
    //     return 'service';
    // }
    
    public function server()
    {
        return $this->belongsTo('App\Library\Models\Server');
    }
    
    public function searchResultString()
    {
        return $this->repository->searchResultString($this);
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
