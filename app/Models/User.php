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

    public $modelService;
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
        $this->modelService = new UserModelService($this);
    }
    
    public function pages()
    {
        return $this->hasMany('App\Models\Page', 'created_by')->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc');
    }
    
    public function suggestedEdits()
    {
        return $this->hasMany('App\Models\SuggestedEdit', 'created_by')->orderBy('updated_at', 'desc');;
    }

    public function userBadges()
    {
        return $this->hasMany('App\Models\UserBadge');
    }
    
    public function specialistAreas($limit = null)
    {
        return $this->modelService->specialistAreas($limit);
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
    
    public function getUserType()
    {
        return $this->modelService->getUserType();
    }
    
    public function getCommunityData()
    {
        return $this->modelService->getCommunityData();
    }
    
    public function getRawCommunityData()
    {
        return $this->modelService->getRawCommunityData();
    }
}
