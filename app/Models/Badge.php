<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    public $guarded = [];

    public function badgeGroup()
    {
        return $this->belongsTo('App\Models\BadgeGroup');
    }

    public function userBadges()
    {
        return $this->hasMany('App\Models\UserBadge');
    }
}
