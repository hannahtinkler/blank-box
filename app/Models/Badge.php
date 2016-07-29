<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    public $guarded = [];

    public function group()
    {
        return $this->belongsTo('App\Models\BadgeGroup', 'badge_group_id');
    }

    public function userBadges()
    {
        return $this->hasMany('App\Models\UserBadge');
    }
}
