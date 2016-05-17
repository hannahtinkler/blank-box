<?php

namespace App\Models;

use App\Interfaces\SearchableModel;
use App\Repositories\ChapterRepository;
use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Chapter extends Model implements SearchableModel
{
    use ElasticquentTrait;
    
    public $guarded = [];
    private $repository;
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
        $this->repository = new ChapterRepository($this);
    }
    
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    
    public function pages()
    {
        return $this->hasMany('App\Models\Page')->orderBy('order');
    }
    
    public function bookmarks()
    {
        return $this->hasOne('App\Models\Bookmark');
    }
    
    public function scopeFindBySlug($query, $slug)
    {
        return $query->where('slug', $slug)->firstOrFail();
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
