<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Elasticquent\ElasticquentTrait;

use App\Repositories\PageRepository;

class Page extends Model
{
    use ElasticquentTrait;
    use SoftDeletes;

    public $guarded = [];
    private $modelService;
    protected $dates = ['deleted_at'];
    protected $mappingProperties = array(
        'title' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
        'content' => [
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
        $this->repository = new PageRepository($this);
    }

    public function __get($name)
    {
        $repository = new PageRepository($this);

        if (method_exists($repository, $name)) {
            return $repository->$name();
        }

        return parent::__get($name);
    }
    
    public function chapter()
    {
        return $this->belongsTo('App\Models\Chapter');
    }
    
    public function bookmark()
    {
        return $this->hasOne('App\Models\Bookmark')->where('user_id', \Auth::user()->id);
    }

    public function creator()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function pageTags()
    {
        return $this->hasMany('App\Models\PageTag');
    }
    
    public function scopeLatestUpdated($query)
    {
        return $query->where('approved', 1)->orderBy('updated_at', 'DESC');
    }
    
    public function scopeFindBySlug($query, $slug)
    {
        return $query->where('slug', $slug)->first();
    }
    
    public function scopeLargestOrderValue($query, $chapterId)
    {
        return $query->where('chapter_id', $chapterId)->orderBy('order', 'desc')->first();
    }
    
    public function getUpdatorsString()
    {
        return $this->modelService->getUpdatorsString();
    }
    
    public function hasEdits()
    {
        return $this->modelService->hasEdits();
    }
}
