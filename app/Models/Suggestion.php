<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    public $guarded = [];
    
    public function page()
    {
        return $this->belongsTo('App\Models\Page');
    }
}
