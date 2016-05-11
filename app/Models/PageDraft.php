<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageDraft extends Model
{
    public $guarded = [];
    
    public function chapter()
    {
        return $this->belongsTo('App\Models\Chapter');
    }
}
