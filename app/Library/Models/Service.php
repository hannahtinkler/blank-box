<?php

namespace App\Library\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $guarded = [];
    
    public function server()
    {
        return $this->belongsTo('App\Library\Models\Server');
    }
}
