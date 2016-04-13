<?php

namespace App\Library\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    public function services()
    {
        return $this->hasMany('App\Library\Models\Service');
    }
}
