<?php

namespace App\Models;

use App\Interfaces\SearchableModel;
use App\Services\ModelServices\PageModelService;
use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model implements SearchableModel
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
        $this->modelService = new PageModelService($this);
    }
    
    public function chapter()
    {
        return $this->belongsTo('App\Models\Chapter');
    }
    
    public function bookmark()
    {
        return $this->hasOne('App\Models\Bookmark');
    }

    public function creator()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }
    
    public function scopeLatestUpdated($query)
    {
        return $query->orderBy('updated_at', 'DESC');
    }
    
    public function scopeFindBySlug($query, $slug)
    {
        return $query->where('slug', $slug)->firstOrFail();
    }
    
    public function scopeLargestOrderValue($query, $chapterId)
    {
        return $query->where('chapter_id', $chapterId)->orderBy('order', 'desc')->first();
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

    public function editableByUser()
    {
        return $this->modelService->editableByUser();
    }
}
