<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageTag extends Model
{
    public $guarded = [];

    public function tag()
    {
        return $this->belongsTo('App\Models\Tag');
    }

    public function page()
    {
        return $this->belongsTo('App\Models\Page');
    }
}
