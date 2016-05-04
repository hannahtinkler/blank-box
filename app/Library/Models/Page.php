<?php

namespace App\Library\Models;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Page extends Model
{
 	use ElasticquentTrait;

    public $guarded = [];
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
	      "analyzer" => "standard"
	    ]
  );
    
    public function chapter()
    {
        return $this->belongsTo('App\Library\Models\Chapter');
    }
    
    public function bookmarks()
    {
        return $this->hasOne('App\Library\Models\Bookmark');
    }
}
