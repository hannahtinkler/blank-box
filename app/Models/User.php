<?php

namespace App\Models;

use Elasticquent\ElasticquentTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Repositories\UserRepository;

class User extends Authenticatable
{
    use ElasticquentTrait;

    public $modelService;
    public $guarded = [];
    protected $mappingProperties = array(
        'name' => [
          'type' => 'string',
          "analyzer" => "standard",
        ]
    );

    public function __get($name)
    {
        $repository = new UserRepository($this);

        if (method_exists($repository, $name)) {
            return $repository->$name();
        }

        return parent::__get($name);
    }
    
    public function pages()
    {
        return $this->hasMany('App\Models\Page', 'created_by')->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc');
    }
    
    public function suggestedEdits()
    {
        return $this->hasMany('App\Models\SuggestedEdit', 'created_by')->orderBy('updated_at', 'desc');
    }

    public function userBadges()
    {
        return $this->hasMany('App\Models\UserBadge');
    }
}
