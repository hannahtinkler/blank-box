<?php

namespace App\Library\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'categories';
    public $guarded = [];

    public function chapters()
    {
        return $this->hasMany('App\Library\Models\Chapter');
    }
}
