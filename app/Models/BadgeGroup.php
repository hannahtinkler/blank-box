<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BadgeGroup extends Model
{
    public $guarded = [];

    public function badgeType()
    {
        return $this->belongsTo('App\Models\BadgeType');
    }

    public function badges()
    {
        return $this->hasMany('App\Models\Badge');
    }
}
