<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BadgeType extends Model
{
    public $guarded = [];

    public function badgeGroups()
    {
        return $this->hasMany('App\Models\BadgeGroup');
    }
}
