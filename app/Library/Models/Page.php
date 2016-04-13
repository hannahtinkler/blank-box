<?php

namespace App\Library\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function chapter()
    {
        return $this->belongsTo('App\Library\Models\Chapter');
    }
}
