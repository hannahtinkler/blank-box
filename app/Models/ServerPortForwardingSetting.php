<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerPortForwardingSetting extends Model
{
    public $timestamps = false;
    
    public function server()
    {
        return $this->belongsTo('App\Models\Server');
    }
}
