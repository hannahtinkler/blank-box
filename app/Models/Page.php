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

    public function __get($name)
    {
        $repository = new PageRepository($this);

        if (method_exists($repository, $name)) {
            return $repository->$name();
        }

        return parent::__get($name);
    }

    public function forgeLinks()
    {
        return $this->hasMany('App\Models\PageForgeLink');
    }

    public function chapter()
    {
        return $this->belongsTo('App\Models\Chapter');
    }

    public function bookmark()
    {
        return $this->hasOne('App\Models\Bookmark')->where('user_id', auth()->user()->id);
    }

    public function creator()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function pageTags()
    {
        return $this->hasMany('App\Models\PageTag');
    }
}
