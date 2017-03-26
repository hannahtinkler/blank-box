<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BadgeType extends Model
{
    public $guarded = [];

    public function badges()
    {
        return $this->hasMany('App\Models\Badge');
    }
}
