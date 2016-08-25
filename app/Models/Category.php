<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Category extends Model
{
    use ElasticquentTrait;

    public $table = 'categories';
    public $guarded = [];
    protected $mappingProperties = array(
        'title' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
        'description' => [
          'type' => 'string',
          "analyzer" => "standard"
        ]
    );

    public function chapters()
    {
        return $this->hasMany('App\Models\Chapter')->orderBy('order');
    }
}
