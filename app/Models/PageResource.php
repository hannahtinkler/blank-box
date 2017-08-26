<?php

namespace App\Models;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

use App\Repositories\PageResourceRepository;

class PageResource extends Model
{
    use ElasticquentTrait;
    
    public $guarded = [];
    
    protected $mappingProperties = array(
        'name' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
        'content' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
    );
    
    public function __get($name)
    {
        $repository = new PageResourceRepository($this);

        if (method_exists($repository, $name)) {
            return $repository->$name();
        }

        return parent::__get($name);
    }
    
    public function page()
    {
        return $this->belongsTo('App\Models\Page');
    }
    
    public function resourceType()
    {
        return $this->belongsTo('App\Models\ResourceType', 'type');
    }

    public function creator()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }
}
