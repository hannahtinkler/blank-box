<?php

namespace App\Models;

use App\Interfaces\SearchableModel;
use App\Services\ModelServices\ServerModelService;
use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Server extends Model implements SearchableModel
{
    use ElasticquentTrait;

    public $guarded = [];
    private $modelService;
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
        $this->modelService = new ServerModelService($this);
    }
    
    public function services()
    {
        return $this->hasMany('App\Models\Service');
    }
    
    public function portForwardingSettings()
    {
        return $this->hasMany('App\Models\ServerPortForwardingSetting');
    }
    
    public function searchResultString()
    {
        return $this->modelService->searchResultString();
    }

    public function searchResultUrl()
    {
        return $this->modelService->searchResultUrl();
    }

    public function searchResultIcon()
    {
        return $this->modelService->searchResultIcon();
    }
}
