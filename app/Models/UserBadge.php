<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBadge extends Model
{
    public $guarded = [];

    public function badge()
    {
        return $this->belongsTo('App\Models\Badge');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
