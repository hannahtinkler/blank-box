<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    public $guarded = [];

    public function type()
    {
        return $this->belongsTo('App\Models\BadgeType', 'badge_type_id');
    }

    public function userBadges()
    {
        return $this->hasMany('App\Models\UserBadge');
    }
}
