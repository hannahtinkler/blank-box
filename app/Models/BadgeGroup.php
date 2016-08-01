<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BadgeGroup extends Model
{
    public $guarded = [];

    public function type()
    {
        return $this->belongsTo('App\Models\BadgeType', 'badge_type_id');
    }

    public function badges()
    {
        return $this->hasMany('App\Models\Badge')->orderBy('level', 'ASC');
    }
}
