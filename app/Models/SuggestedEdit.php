<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuggestedEdit extends Model
{
    use SoftDeletes;

    public $guarded = [];
    private $modelService;

    public function page()
    {
        return $this->belongsTo('App\Models\Page');
    }

    public function chapter()
    {
        return $this->belongsTo('App\Models\Chapter');
    }
    
    public function creator()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }
}
