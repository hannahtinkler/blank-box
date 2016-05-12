<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    public $guarded = [];
    protected $mappingProperties = array(
        'comment' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
    );
    
    public function chapter()
    {
        return $this->belongsTo('App\Models\Chapter');
    }
}
