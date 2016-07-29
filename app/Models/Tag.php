<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    public $timestamps = false;
    public $guarded = [];

    public function pageTags()
    {
        return $this->hasMany('App\Models\PageTag');
    }
}
