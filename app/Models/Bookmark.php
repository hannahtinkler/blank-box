<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    public $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function chapter()
    {
        return $this->belongsTo('App\Models\Chapter');
    }

    public function page()
    {
        return $this->belongsTo('App\Models\Page');
    }
}
