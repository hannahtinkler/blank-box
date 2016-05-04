<?php

namespace App\Library\Models;

use App\Library\Interfaces\SearchableModel;
use App\Library\Repositories\ChapterRepository;
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

    public function getTypeName()
    {
        return 'chapter';
    }
    
    public function category()
    {
        return $this->belongsTo('App\Library\Models\Category');
    }
    
    public function pages()
    {
        return $this->hasMany('App\Library\Models\Page')->orderBy('order');
    }
    
    public function bookmarks()
    {
        return $this->hasOne('App\Library\Models\Bookmark');
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
