<?php

namespace App\Library\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    public $guarded = [];

    public function chapter()
    {
        return $this->belongsTo('App\Library\Models\Chapter');
    }

    public function page()
    {
        return $this->belongsTo('App\Library\Models\Page');
    }
}
