<?php

namespace App\Models;

use App\Interfaces\SearchableModel;
use App\Services\ModelServices\ChapterModelService;
use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Chapter extends Model implements SearchableModel
{
    use ElasticquentTrait;
    
    public $guarded = [];
    private $modelService;
    protected $mappingProperties = array(
        'title' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
        'description' => [
          'type' => 'string',
          "analyzer" => "standard",
        ]
    );

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->modelService = new ChapterModelService($this);
    }
    
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    
    public function pages()
    {
        return $this->hasMany('App\Models\Page')->where('approved', 1)->orderBy('title')->orderBy('order');
    }
    
    public function bookmark()
    {
        return $this->hasOne('App\Models\Bookmark');
    }
    
    public function approvedPages()
    {
        return $this->hasMany('App\Models\Page')->where('approved', true)->orderBy('order');
    }
    
    public function scopeLargestOrderValue($query, $categoryId)
    {
        return $query->where('category_id', $categoryId)->orderBy('order', 'desc')->first();
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
