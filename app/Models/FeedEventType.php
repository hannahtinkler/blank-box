<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedEventType extends Model
{
    public $guarded = [];

    public function feedEvents()
    {
        return $this->hasMany('App\Models\FeedEvent');
    }
}
